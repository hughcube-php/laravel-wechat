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
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserMessage;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserMessageLocation;
use HughCube\Laravel\WeChat\Tests\TestCase;
use HughCube\Laravel\WeChat\WeChat;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Str;

class UserMessageLocationTest extends TestCase
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
                    'MsgType' => 'location',
                    'Location_X' => rand(-9000, 9000) / 100,
                    'Location_Y' => rand(-18000, 18000) / 100,
                    'Scale' => rand(0, 50),
                    'Label' => Str::random(),
                    'MsgId' => crc32(Str::random()),
                ]
            ],
            [
                [
                    'ToUserName' => Str::random(),
                    'FromUserName' => Str::random(),
                    'CreateTime' => time(),
                    'MsgType' => 'location',
                    'Location_X' => rand(-9000, 9000) / 100,
                    'Location_Y' => rand(-18000, 18000) / 100,
                    'Scale' => rand(0, 50),
                    'Label' => Str::random(),
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
        /** @var UserMessageLocation $message */
        $message = WeChat::createOfficialAccountEvent($data);

        $this->assertInstanceOf(Event::class, $message);
        $this->assertInstanceOf(UserMessage::class, $message);
        $this->assertInstanceOf(UserMessageLocation::class, $message);

        $this->assertInstanceOf(LocationMessage::class, $message);

        $this->assertMessage($message, $data);
        $this->assertEquals($message->getLatitude(), $data['Location_X']);
        $this->assertEquals($message->getLongitude(), $data['Location_Y']);
        $this->assertEquals($message->getScale(), $data['Scale']);
        $this->assertSame($message->getLabel(), $data['Label']);
    }
}
