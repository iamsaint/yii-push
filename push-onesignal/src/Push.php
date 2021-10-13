<?php

declare(strict_types=1);

namespace Yiisoft\Push\OneSignal;

use Yiisoft\Push\Message;
use Yiisoft\Push\PushInterface;

final class Push implements PushInterface
{
    private const DEFAULT_LANGUAGE = 'en';

    private array $messages = [];

    public function addMessage(Message $message): void
    {
        $this->messages[] = $message;
    }

    public function getNotifications(): array
    {
        $result = ['contents' => [], 'headings' => []];

        foreach ($this->messages as $message) {
            $result['headings'][$message->getLanguage()] = $message->getTitle();
            $result['contents'][$message->getLanguage()] = $message->getBody();

            if(!array_key_exists(self::DEFAULT_LANGUAGE, $result['headings'])) {
                $result['headings'] = $message->getTitle();
            }

            if(!array_key_exists(self::DEFAULT_LANGUAGE, $result['contents'])) {
                $result['contents'] = $message->getBody();
            }

        }

        return $result;
    }
}
