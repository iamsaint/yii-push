<?php

declare(strict_types=1);

namespace Yiisoft\Push;

final class Message
{
    private string $title;
    private string $body;
    private string $language;
    private ?string $icon = null;
    private ?string $clickAction = null;

    public function __construct(string $title, string $body, string $language)
    {
        $this->title = $title;
        $this->body = $body;
        $this->language = $language;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function withIcon(string $icon): Message
    {
        $instance = clone $this;
        $instance->icon = $icon;
        return $instance;
    }

    public function withClickAction(string $clickAction): Message
    {
        $instance = clone $this;
        $instance->clickAction = $clickAction;
        return $instance;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function getClickAction(): ?string
    {
        return $this->clickAction;
    }
}
