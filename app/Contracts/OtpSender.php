<?php

namespace App\Contracts;

use File;

interface OtpSender
{
    public function send(string $to , string $code): void;

    public function sendNotification(string $to, string $message, ?string $subject = null , ?File $file = null): bool;
}
