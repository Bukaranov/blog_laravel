<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendVerifayWithQueueNotification extends VerifyEmail implements ShouldQueue
{
    use Queueable;
}
