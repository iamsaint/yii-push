<?php

declare(strict_types=1);

namespace Yiisoft\Push\Firebase;

use GuzzleHttp\Client;
use Yiisoft\Push\PushInterface;
use Yiisoft\Push\PushProviderInterface;
use Yiisoft\Push\SegmentInterface;
use Yiisoft\Push\SegmentTypeEnum;

final class Provider implements PushProviderInterface
{
    private const API_URL = 'https://fcm.googleapis.com/fcm/';
    private string $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function createPush(): PushInterface
    {
        return new Push();
    }

    public function send(PushInterface $push, SegmentInterface $segment)
    {
        $headers = [
            'Authorization' => 'key=' . $this->apiKey,
            'Content-Type' => 'application/json',
        ];

        $client = new Client();

        $fields = [
            'content-available' => true,
            'priority' => 'high',
        ];

        $result = [];

        foreach ($segment->getSegments() as $segmentName) {
            $_fields = $fields;
            switch ($segment->getType()) {
                case SegmentTypeEnum::TYPE_TOPIC:
                    $_fields['to'] = '/topics/' . $segmentName;
                    break;
                case SegmentTypeEnum::TYPE_DEVICE:
                    $_fields['to'] = $segmentName;
                    break;
                default:
                    throw new \InvalidArgumentException('Invalid segment type');
            }

            foreach ($push->getNotifications() as $notification) {
                $_fields['notification'] = $notification;

                $response = $client->post(self::API_URL . 'send', [
                    'headers' => $headers,
                    'json' => $_fields
                ]);

                $result[] = json_decode($response->getBody()->getContents(), true);
            }
        }

        return $result;
    }
}

