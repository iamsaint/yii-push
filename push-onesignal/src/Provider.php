<?php

declare(strict_types=1);

namespace Yiisoft\Push\OneSignal;

use GuzzleHttp\Client as GuzzleClient;
use Http\Adapter\Guzzle7\Client as GuzzleAdapter;
use Http\Client\Common\HttpMethodsClient as HttpClient;
use Http\Message\MessageFactory\GuzzleMessageFactory;
use Nyholm\Psr7\Factory\Psr17Factory;
use OneSignal\Config;
use OneSignal\OneSignal;
use Yiisoft\Push\PushInterface;
use Yiisoft\Push\PushProviderInterface;
use Yiisoft\Push\SegmentInterface;
use Yiisoft\Push\SegmentTypeEnum;

final class Provider implements PushProviderInterface
{
    private OneSignal $api;

    public function __construct(string $appId, string $applicationAuthKey, string $userAuthKey)
    {
        $this->init($appId, $applicationAuthKey, $userAuthKey);
    }

    public function createPush(): PushInterface
    {
        return new Push();
    }

    private function init(string $appId, string $applicationAuthKey, string $userAuthKey)
    {
        $config = new Config($appId, $applicationAuthKey, $userAuthKey);

        $guzzle = new GuzzleClient();

        $client = new HttpClient(new GuzzleAdapter($guzzle), new GuzzleMessageFactory());

        $requestFactory = $streamFactory = new Psr17Factory();

        $this->api = new OneSignal($config, $client, $requestFactory, $streamFactory);
    }

    public function send(PushInterface $push, SegmentInterface $segment)
    {
        $notifications = $push->getNotifications();

        switch ($segment->getType()) {
            case SegmentTypeEnum::TYPE_TOPIC:
                $notifications['included_segments'] = $segment->getSegments();
                break;
            case SegmentTypeEnum::TYPE_DEVICE:
                $notifications['include_player_ids'] = $segment->getSegments();
                break;
            default:
                throw new \InvalidArgumentException('Invalid segment type');
        }
var_dump($notifications);die;
        return $this->api->notifications()->add($notifications);
    }
}

