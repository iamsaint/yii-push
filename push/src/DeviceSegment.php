<?php

declare(strict_types=1);

namespace Yiisoft\Push;

final class DeviceSegment implements SegmentInterface
{
    private array $segments = [];

    public function add(string $segment)
    {
        $this->segments[] = $segment;
    }

    public function getSegments(): array
    {
        return $this->segments;
    }

    public function getType(): int
    {
        return SegmentTypeEnum::TYPE_DEVICE;
    }
}
