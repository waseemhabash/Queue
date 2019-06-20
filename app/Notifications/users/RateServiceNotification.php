<?php

namespace App\Notifications\users;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\OneSignal\OneSignalChannel;
use NotificationChannels\OneSignal\OneSignalMessage;
use NotificationChannels\OneSignal\OneSignalWebButton;

class RateServiceNotification extends Notification
{
    use Queueable;

   
    public function __construct($service)
    {
        $this->service = $service;
    }

    
    public function via($notifiable)
    {
        return [OneSignalChannel::class];
    }

    public function toOneSignal($notifiable)
    {
        $subject = "subject";
        $body = "Body";
        return OneSignalMessage::create()
            ->subject($subject)
            ->body($body);
    }

}
