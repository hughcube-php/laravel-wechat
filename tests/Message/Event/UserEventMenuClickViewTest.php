<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Tests\Message\Event;

use HughCube\Laravel\WeChat\Contracts\Message\Event\Event;
use HughCube\Laravel\WeChat\Contracts\Message\Event\LinkMessage;
use HughCube\Laravel\WeChat\Contracts\Message\Event\OpenIdMessage;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEvent;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEventMenu;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEventMenuClickView;
use HughCube\Laravel\WeChat\Tests\TestCase;
use HughCube\Laravel\WeChat\WeChat;
use HughCube\PUrl\HUrl;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Str;

class UserEventMenuClickViewTest extends TestCase
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
                    'Event' => 'VIEW',
                    'EventKey' => sprintf("https://%s.com", Str::random()),
                ]
            ],
            [
                [
                    'ToUserName' => Str::random(),
                    'FromUserName' => Str::random(),
                    'CreateTime' => time(),
                    'MsgType' => 'event',
                    'Event' => 'VIEW',
                    'EventKey' => sprintf("https://%s.com", Str::random()),
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
        /** @var UserEventMenuClickView $message */
        $message = WeChat::createOfficialAccountEvent($data);

        $this->assertInstanceOf(Event::class, $message);
        $this->assertInstanceOf(UserEvent::class, $message);
        $this->assertInstanceOf(UserEventMenuClickView::class, $message);

        $this->assertInstanceOf(OpenIdMessage::class, $message);
        $this->assertInstanceOf(LinkMessage::class, $message);
        $this->assertInstanceOf(UserEventMenu::class, $message);

        $this->assertMessage($message, $data);
        $this->assertSame($message->getEventKey(), $data['EventKey']);
        $this->assertSame($message->getEventKey(), $message->getUrl()->toString());
    }
}
