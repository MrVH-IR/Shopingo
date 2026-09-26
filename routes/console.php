<?php

use App\Jobs\Admin\Notification\SendNotificationJob;
use App\Models\Notify\Email;
use App\Models\Notify\SMS;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    Email::query()
        ->where('status', 0)
        ->where('published_at', '<=', now())
        ->each(function (Email $email) {
            SendNotificationJob::dispatch(
                notificationId: $email->id,
                model: $email
            );
        });
})->everyMinute();

Schedule::call(function () {
    SMS::query()
        ->where('status', 0)
        ->where('published_at', '<=', now())
        ->each(function (SMS $sms) {
            SendNotificationJob::dispatch(
                notificationId: $sms->id,
                model: $sms
            );
        });
})->everyMinute();
