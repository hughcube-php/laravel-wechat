<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/25
 * Time: 15:29
 */

namespace HughCube\Laravel\WeChat\Tests;

use HughCube\Laravel\WeChat\WeChat;

class WeChatTest extends TestCase
{
    public function testStore()
    {
        $this->assertTrue(is_subclass_of(
            WeChat::class,
            \Overtrue\LaravelWeChat\Facade::class
        ));
    }
}
