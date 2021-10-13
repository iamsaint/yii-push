<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Yiisoft\Push\Firebase\Provider;
use Yiisoft\Push\DeviceSegment;
use Yiisoft\Push\Message;

$API_KEY = 'FIREBASE API KEY';
$DEVIDE_KEY = 'YOUR DEVICE KEY';

$provider = new Provider($API_KEY);
$push = $provider->createPush();
$message = new Message('Test title', 'Test body', 'ru');

$push->addMessage($message);

$segment = new DeviceSegment();
$segment->add($DEVIDE_KEY);

$result = $provider->send($push, $segment);

var_dump($result);
