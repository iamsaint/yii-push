<?php

declare(strict_types=1);

namespace Yiisoft\Push\Firebase;

use Yiisoft\Push\Message;
use Yiisoft\Push\PushInterface;

final class Push implements PushInterface
{
    private array $messages = [];

    public function addMessage(Message $message): void
    {
        $this->messages[] = $message;
    }

    public function getNotifications(): array
    {
        $result = [];
        foreach ($this->messages as $message) {
            $push = [
                'title' => $message->getTitle(),
                'body' => $message->getBody(),
            ];

            if ($icon = $message->getIcon()) {
                $push['icon'] = $icon;
            }

            if ($clickAction = $message->getClickAction()) {
                $push['click_action'] = $clickAction;
            }

            $result[$message->getLanguage()] = $push;
        }

        return $result;
    }
}
