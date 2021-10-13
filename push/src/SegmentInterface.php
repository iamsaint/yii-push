<?php

declare(strict_types=1);

namespace Yiisoft\Push;

interface SegmentInterface
{
    public function add(string $segment);

    public function getSegments(): array;

    public function getType(): int;
}
