<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Tests\Message\Event;

use HughCube\Laravel\WeChat\Contracts\Message\Event\Event;
use HughCube\Laravel\WeChat\Contracts\Message\Event\OpenIdMessage;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEvent;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEventSubscribe;
use HughCube\Laravel\WeChat\Tests\TestCase;
use HughCube\Laravel\WeChat\WeChat;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Str;

class UserEventSubscribeTest extends TestCase
{
    /**
     * @return array
     */
    public function messageDataProvider(): array
    {
        return [
            [
                [
                    'ToUserName' => Str::random(),
                    'FromUserName' => Str::random(),
                    'CreateTime' => time(),
                    'MsgType' => 'event',
                    'Event' => 'subscribe',
                ]
            ],
            [
                [
                    'ToUserName' => Str::random(),
                    'FromUserName' => Str::random(),
                    'CreateTime' => time(),
                    'MsgType' => 'event',
                    'Event' => 'subscribe',
                ]
            ]
        ];
    }

    /**
     * @dataProvider messageDataProvider
     * @return void
     * @throws BindingResolutionException
     */
    public function testMessage($data)
    {
        /** @var UserEventSubscribe $message */
        $message = WeChat::createOfficialAccountEvent($data);

        $this->assertInstanceOf(Event::class, $message);
        $this->assertInstanceOf(UserEvent::class, $message);
        $this->assertInstanceOf(UserEventSubscribe::class, $message);

        $this->assertInstanceOf(OpenIdMessage::class, $message);

        $this->assertMessage($message, $data);
        $this->assertFalse($message->isScan());
    }
}
