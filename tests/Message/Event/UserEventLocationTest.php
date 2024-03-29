<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Tests\Message\Event;

use HughCube\Laravel\WeChat\Contracts\Message\Event\Event;
use HughCube\Laravel\WeChat\Contracts\Message\Event\LocationMessage;
use HughCube\Laravel\WeChat\Contracts\Message\Event\OpenIdMessage;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEvent;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEventLocation;
use HughCube\Laravel\WeChat\Tests\TestCase;
use HughCube\Laravel\WeChat\WeChat;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Str;

class UserEventLocationTest extends TestCase
{
    /**
     * @return array
     */
    public static function messageDataProvider(): array
    {
        return [
            [
                [
                    'ToUserName' => Str::random(),
                    'FromUserName' => Str::random(),
                    'CreateTime' => time(),
                    'MsgType' => 'event',
                    'Event' => 'LOCATION',
                    'Latitude' => rand(-9000, 9000) / 100,
                    'Longitude' => rand(-18000, 18000) / 100,
                    'Precision' => rand(-18000, 18000) / 100,
                ]
            ],
            [
                [
                    'ToUserName' => Str::random(),
                    'FromUserName' => Str::random(),
                    'CreateTime' => time(),
                    'MsgType' => 'event',
                    'Event' => 'LOCATION',
                    'Latitude' => rand(-9000, 9000) / 100,
                    'Longitude' => rand(-18000, 18000) / 100,
                    'Precision' => rand(-18000, 18000) / 100,
                ]
            ]
        ];
    }

    /**
     * @dataProvider messageDataProvider
     * @return void
     */
    public function testMessage($data)
    {
        /** @var UserEventLocation $message */
        $message = WeChat::createOfficialAccountEvent($data);

        $this->assertInstanceOf(Event::class, $message);
        $this->assertInstanceOf(UserEvent::class, $message);
        $this->assertInstanceOf(UserEventLocation::class, $message);

        $this->assertInstanceOf(LocationMessage::class, $message);
        $this->assertInstanceOf(OpenIdMessage::class, $message);

        $this->assertMessage($message, $data);
        $this->assertEquals($message->getLatitude(), $data['Latitude']);
        $this->assertEquals($message->getLongitude(), $data['Longitude']);
        $this->assertEquals($message->getPrecision(), $data['Precision']);
    }
}
