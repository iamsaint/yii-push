<?php

declare(strict_types=1);

namespace Yiisoft\Push;

final class TopicSegment implements SegmentInterface
{
    private array $segments = [];

    public function add(string $segment): SegmentInterface
    {
        $instance = clone $this;
        $instance->segments[] = $segment;
        return $instance;
    }

    public function getSegments(): array
    {
        return $this->segments;
    }

    public function getType(): string
    {
        return SegmentTypeEnum::TYPE_TOPIC;
    }
}
