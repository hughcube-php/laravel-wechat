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
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserMessage;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserMessageLink;
use HughCube\Laravel\WeChat\Tests\TestCase;
use HughCube\Laravel\WeChat\WeChat;
use HughCube\PUrl\HUrl;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Str;

class UserMessageLinkTest extends TestCase
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
                    'MsgType' => 'link',
                    'Title' => Str::random(),
                    'Description' => Str::random(),
                    'Url' => sprintf("https://%s.com", Str::random()),
                    'MsgId' => crc32(Str::random()),
                ]
            ],
            [
                [
                    'ToUserName' => Str::random(),
                    'FromUserName' => Str::random(),
                    'CreateTime' => time(),
                    'MsgType' => 'link',
                    'Title' => Str::random(),
                    'Description' => Str::random(),
                    'Url' => sprintf("https://%s.com", Str::random()),
                    'MsgId' => crc32(Str::random()),
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
        /** @var UserMessageLink $message */
        $message = WeChat::createOfficialAccountEvent($data);

        $this->assertInstanceOf(Event::class, $message);
        $this->assertInstanceOf(UserMessage::class, $message);
        $this->assertInstanceOf(UserMessageLink::class, $message);

        $this->assertInstanceOf(LinkMessage::class, $message);

        $this->assertMessage($message, $data);
        $this->assertSame($message->getTitle(), $data['Title']);
        $this->assertSame($message->getDescription(), $data['Description']);
        $this->assertSame($message->getUrl()->toString(), $data['Url']);
    }
}
