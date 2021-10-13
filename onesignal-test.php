<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Yiisoft\Push\OneSignal\Provider;
use Yiisoft\Push\DeviceSegment;
use Yiisoft\Push\Message;

$params = [
    'appId' => 'OneSignal app id',
    'applicationAuthKey' => 'OneSignal app auth key',
    'userAuthKey' => 'OneSignal user auth key',
];

$DEVIDE_KEY = 'YOUR DEVICE KEY';

$provider = new Provider(
    $params['appId'], $params['applicationAuthKey'], $params['userAuthKey']
);

$push = $provider->createPush();
$message = new Message('Test title', 'Test body', 'ru');

$push->addMessage($message);

$segment = new DeviceSegment();
$segment->add($DEVIDE_KEY);

$result = $provider->send($push, $segment);

var_dump($result);
