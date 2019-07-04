<?php

namespace NotificationChannels\SmsBroadcast;

class SmsBroadcastMessage
{
    /** @var string */
    public $content;

    /** @var string|null */
    public $sender = null;

    /** @var string|null */
    public $reference = null;

    /** @var int|null */
    public $delay = null;

    public function __construct(string $content = '')
    {
        $this->content = $content;
    }

    public function content(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function sender(string $sender): self
    {
        $this->sender = $sender;
        return $this;
    }

    public function delay(int $delayMinutes): self
    {
        $this->delay = $delayMinutes;
        return $this;
    }

    public function reference(string $reference): self
    {
        $this->reference = $reference;
        return $this;
    }
}
