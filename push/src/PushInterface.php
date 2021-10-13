<?php

declare(strict_types=1);

namespace Yiisoft\Push;

interface PushInterface
{
    public function addMessage(Message $message): void;

    public function getNotifications(): array;
}
