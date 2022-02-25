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
use HughCube\Laravel\WeChat\Contracts\Message\Event\TemplateMessageEvent;
use HughCube\Laravel\WeChat\Contracts\Message\Event\TemplateMessageEventSendJobFinish;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEvent;
use HughCube\Laravel\WeChat\Tests\TestCase;
use HughCube\Laravel\WeChat\WeChat;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Str;

class TemplateMessageEventSendJobFinishTest extends TestCase
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
                    'Event' => 'TEMPLATESENDJOBFINISH',
                    'MsgID' => crc32(Str::random()),
                    'Status' => Str::random(),
                ]
            ],
            [
                [
                    'ToUserName' => Str::random(),
                    'FromUserName' => Str::random(),
                    'CreateTime' => time(),
                    'MsgType' => 'event',
                    'Event' => 'TEMPLATESENDJOBFINISH',
                    'MsgID' => crc32(Str::random()),
                    'Status' => 'success',
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
        /** @var TemplateMessageEventSendJobFinish $message */
        $message = WeChat::createOfficialAccountEvent($data);

        $this->assertInstanceOf(Event::class, $message);
        $this->assertInstanceOf(UserEvent::class, $message);
        $this->assertInstanceOf(TemplateMessageEventSendJobFinish::class, $message);

        $this->assertInstanceOf(TemplateMessageEvent::class, $message);
        $this->assertInstanceOf(OpenIdMessage::class, $message);

        $this->assertMessage($message, $data);
        $this->assertSame($message->getStatus(), $data['Status']);
        $this->assertSame($message->isSuccess(), 'success' === $data['Status']);
    }
}
