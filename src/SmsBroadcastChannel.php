<?php

namespace NotificationChannels\SmsBroadcast;

use Atymic\SmsBroadcast\Api\Client;
use Illuminate\Notifications\Notification;
use NotificationChannels\SmsBroadcast\Exceptions\CouldNotSendNotification;

class SmsBroadcastChannel
{
    /** @var Client */
    private $smsBroadcastClient;

    public function __construct(Client $smsBroadcastClient)
    {
        $this->smsBroadcastClient = $smsBroadcastClient;
    }

    public function send($notifiable, Notification $notification): void
    {
        if (!$to = $notifiable->routeNotificationFor('smsbroadcast')) {
            return;
        }

        $message = $notification->toSmsBroadcast();

        if (is_string($message)) {
            $message = new SmsBroadcastMessage($message);
        }

        $this->smsBroadcastClient->send(
            $to,
            $message->content,
            $message->sender,
            $message->reference,
            true,
            $message->delay
        );
    }
}
