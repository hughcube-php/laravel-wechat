<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/4/20
 * Time: 11:36 下午.
 */

namespace HughCube\Laravel\WeChat\Tests;

use HughCube\Laravel\WeChat\Contracts\Message\Event\Event;
use HughCube\Laravel\WeChat\Contracts\Message\Event\EventMessage;
use HughCube\Laravel\WeChat\Contracts\Message\Event\MessageIdMessage;
use HughCube\Laravel\WeChat\Contracts\Message\Event\OpenIdMessage;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEvent;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserMessage;
use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * @param  Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [];
    }

    /**
     * @param  Application  $app
     */
    protected function getEnvironmentSetUp($app)
    {
    }

    protected function assertMessage(Event $event, $data)
    {
        $this->assertSame($event->getFromUserName(), $data['FromUserName']);
        $this->assertSame($event->getToUserName(), $data['ToUserName']);
        $this->assertSame($event->getCreatedAt()->getTimestamp(), $data['CreateTime']);
        $this->assertSame($event->getMessageType(), $data['MsgType']);

        /** 用户行为触发的一定有openid */
        if ($event instanceof UserEvent) {
            $this->assertInstanceOf(OpenIdMessage::class, $event);
        }

        /** 用户发送的消息一定有openid */
        if ($event instanceof UserMessage) {
            $this->assertInstanceOf(OpenIdMessage::class, $event);
        }

        /** 用户发送的消息一定有messageID */
        if ($event instanceof UserMessage) {
            $this->assertInstanceOf(MessageIdMessage::class, $event);
        }

        if ($event instanceof MessageIdMessage) {
            $this->assertSame($event->getMessageId(), $data['MsgId'] ?? $data['MsgID']);
        }

        if ($event instanceof OpenIdMessage) {
            $this->assertSame($event->getFromUserName(), $event->getOpenID());
        }

        if ($event instanceof OpenIdMessage) {
            $this->assertSame($event->getFromUserName(), $event->getOpenID());
        }

        if ($event instanceof EventMessage) {
            $this->assertSame($event->getEvent(), $data['Event']);
            $this->assertSame($event->getEventKey(), $data['EventKey'] ?? null);
        }
    }
}
