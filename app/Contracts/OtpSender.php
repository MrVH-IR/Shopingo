<?php

namespace App\Contracts;

interface OtpSender
{
    public function send(string $to , string $code): void;
}
