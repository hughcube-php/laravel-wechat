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
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserMessageImage;
use HughCube\Laravel\WeChat\Tests\TestCase;
use HughCube\Laravel\WeChat\WeChat;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Str;

class UserMessageImageTest extends TestCase
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
                    'MsgType' => 'image',
                    'PicUrl' => Str::random(),
                    'MediaId' => Str::random(),
                    'MsgId' => crc32(Str::random()),
                ]
            ],
            [
                [
                    'ToUserName' => Str::random(),
                    'FromUserName' => Str::random(),
                    'CreateTime' => time(),
                    'MsgType' => 'image',
                    'PicUrl' => Str::random(),
                    'MediaId' => Str::random(),
                    'MsgId' => crc32(Str::random()),
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
        /** @var UserMessageImage $message */
        $message = WeChat::createOfficialAccountEvent($data);

        $this->assertInstanceOf(Event::class, $message);
        $this->assertInstanceOf(UserMessage::class, $message);
        $this->assertInstanceOf(UserMessageImage::class, $message);

        $this->assertMessage($message, $data);
        $this->assertSame($message->getPicUrl(), $data['PicUrl']);
        $this->assertSame($message->getMediaId(), $data['MediaId']);
    }
}
