<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Tests\Message\Event;

use HughCube\Laravel\WeChat\Contracts\Message\Event\Event;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserMessage;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserMessageVideo;
use HughCube\Laravel\WeChat\Tests\TestCase;
use HughCube\Laravel\WeChat\WeChat;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Str;

class UserMessageVideoTest extends TestCase
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
                    'MsgType' => 'video',
                    'MediaId' => Str::random(),
                    'ThumbMediaId' => Str::random(),
                    'MsgId' => crc32(Str::random()),
                ]
            ],
            [
                [
                    'ToUserName' => Str::random(),
                    'FromUserName' => Str::random(),
                    'CreateTime' => time(),
                    'MsgType' => 'video',
                    'MediaId' => Str::random(),
                    'ThumbMediaId' => Str::random(),
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
        /** @var UserMessageVideo $message */
        $message = WeChat::createOfficialAccountEvent($data);

        $this->assertInstanceOf(Event::class, $message);
        $this->assertInstanceOf(UserMessage::class, $message);
        $this->assertInstanceOf(UserMessageVideo::class, $message);

        $this->assertMessage($message, $data);
        $this->assertEquals($message->getMediaId(), $data['MediaId']);
        $this->assertEquals($message->getThumbMediaId(), $data['ThumbMediaId']);
    }
}
