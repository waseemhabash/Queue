<?php

namespace App\Notifications\users;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\OneSignal\OneSignalChannel;
use NotificationChannels\OneSignal\OneSignalMessage;

class RateServiceNotification extends Notification
{
    use Queueable;

    public function __construct($queue)
    {
        $this->queue = $queue;
    }

    public function via($notifiable)
    {
        return [OneSignalChannel::class];
    }

    public function toOneSignal($notifiable)
    {
        $subject = "تقييم الخدمة";
        $body = "تم إنجاز الخدمة ( " . $this->queue->service->name . " )";
        return OneSignalMessage::create()
            ->subject($subject)
            ->body($body)
            ->setData("queue_id", $this->queue->id);
    }

}
