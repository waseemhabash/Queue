<?php

namespace App\Notifications\users;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\OneSignal\OneSignalChannel;
use NotificationChannels\OneSignal\OneSignalMessage;

class ConfirmReservationNotification extends Notification
{
    use Queueable;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function via($notifiable)
    {
        return [OneSignalChannel::class];
    }

    public function toOneSignal($notifiable)
    {
        $subject = "  بقي القليل لموعدك في " . $this->reservation->service->branch->name;
        $body = "اضغط لتأكيد الموعد أو إلغاءه - " . $this->reservation->service->name;
        return OneSignalMessage::create()
            ->subject($subject)
            ->body($body)
            ->setData("reservation_id", $this->reservation->id)
            ->setData("service_id", $this->reservation->service_id);
    }
}
