<?php

namespace App\Observers\Admin;

use App\Jobs\Admin\Notification\SendNotificationJob;
use App\Models\Notify\SMS;

class SmsObserver
{
    /**
     * Handle the SMS "created" event.
     */
    public function created(SMS $sms): void
    {
        SendNotificationJob::dispatch(
            notificationId: $sms->id,
            model: $sms,
        );
    }

    /**
     * Handle the SMS "updated" event.
     */
    public function updated(SMS $sms): void
    {
        //
    }

    /**
     * Handle the SMS "deleted" event.
     */
    public function deleted(SMS $sms): void
    {
        //
    }

    /**
     * Handle the SMS "restored" event.
     */
    public function restored(SMS $sms): void
    {
        //
    }

    /**
     * Handle the SMS "force deleted" event.
     */
    public function forceDeleted(SMS $sms): void
    {
        //
    }
}
