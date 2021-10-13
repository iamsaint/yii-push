<?php

declare(strict_types=1);

use Yiisoft\Push\PushProviderInterface;

return [
    PushProviderInterface::class => [
        '__constrict()' => $params['yiisoft/push']['connection']
    ]
];
