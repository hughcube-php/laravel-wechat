<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Tests\Message\Event;

use HughCube\Laravel\WeChat\Contracts\Message\Event\Event;
use HughCube\Laravel\WeChat\Contracts\Message\Event\ScanMessage;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEvent;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEventSubscribe;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEventSubscribeWithScan;
use HughCube\Laravel\WeChat\Tests\TestCase;
use HughCube\Laravel\WeChat\WeChat;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Str;

class UserEventSubscribeWithScanTest extends TestCase
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
                    'EventKey' => sprintf('qrscene_%s', Str::random()),
                    'Ticket' => Str::random(),
                ]
            ],
            [
                [
                    'ToUserName' => Str::random(),
                    'FromUserName' => Str::random(),
                    'CreateTime' => time(),
                    'MsgType' => 'event',
                    'Event' => 'subscribe',
                    'EventKey' => sprintf('qrscene_%s', Str::random()),
                    'Ticket' => Str::random(),
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
        /** @var UserEventSubscribeWithScan $message */
        $message = WeChat::createOfficialAccountEvent($data);

        $this->assertInstanceOf(Event::class, $message);
        $this->assertInstanceOf(UserEvent::class, $message);
        $this->assertInstanceOf(UserEventSubscribeWithScan::class, $message);

        $this->assertInstanceOf(UserEventSubscribe::class, $message);
        $this->assertInstanceOf(ScanMessage::class, $message);

        $this->assertMessage($message, $data);
        $this->assertTrue($message->isScan());
        $this->assertSame($message->getTicket(), $data['Ticket']);
        $this->assertSame($message->getScene(), Str::afterLast($data['EventKey'], 'qrscene_'));
    }
}
