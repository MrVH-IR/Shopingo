<?php

namespace App\Jobs\Admin\Notification;

use App\Http\Services\OtpService\EmailOtpSender;
use App\Http\Services\OtpService\SmsOtpSender;
use App\Models\Notify\Email;
use App\Models\Notify\SMS;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendNotificationJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public  int                     $notificationId,
        public  Model                   $model,
    )
    {}

    /**
     * Execute the job.
     * @throws Throwable
     */
    public function handle(
        EmailOtpSender $emailOtpSender,
        SmsOtpSender $smsOtpSender
    ): void
    {
        Log::info('SendNotificationJob Started', [
            'id' => $this->notificationId,
            'model' => get_class($this->model),
        ]);
        $model = get_class($this->model);
        $notification = $model::findOrFail($this->notificationId);

        if ($notification->status !== 0 || $notification->published_at > now()) {
            Log::warning('Notification Was Not Send', [
                'NotificationID' => $this->notificationId ?? null,
                'Model' => $model ?? null,
                'NotificationStatus' => $notification->status ?? null,
            ]);
            return;
        }

        if ($model === SMS::class) {
            Log::info("SMS Job Has Been Run");
            $users = Cache::remember('users:mobile', now()->addHour(), fn() => User::query()->whereNotNull('mobile')->select('mobile')->get());
            foreach ($users as $user) {
                $retryUse = $smsOtpSender->sendNotification($user->mobile, $notification->body);
                if ($retryUse === false) {
                    retry(2 , fn() => $smsOtpSender->sendNotification($user->mobile, $notification->body), 1000, Exception::class);
                }
            }
            $model::whereId($this->notificationId)->update(['status' => 1]);
        } elseif ($model === Email::class) {
            Log::info("Email Job Has Be Run");
            $users = Cache::remember('users:email', now()->addHour(), fn() => User::query()->whereNotNull('email')->select('email')->get());
            foreach ($users as $user) {
                $retryUse = $emailOtpSender->sendNotification($user->email, $notification->body, $notification->subject);
                if ($retryUse === false) {
                    retry(2, fn() => $emailOtpSender->sendNotification($user->email, $notification->body, $notification->subject),1000, Exception::class);
                }
            }
            $model::whereId($this->notificationId)->update(['status' => 1]);
        }
    }
}
