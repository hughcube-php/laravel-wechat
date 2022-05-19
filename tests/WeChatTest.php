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
use HughCube\Laravel\WeChat\Contracts\Message\Event\TemplateMessageEvent;
use HughCube\Laravel\WeChat\Contracts\Message\Event\TemplateMessageEventSendJobFinish;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEvent;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserMessage;
use HughCube\Laravel\WeChat\ServiceProvider;
use HughCube\Laravel\WeChat\WeChat;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class WeChatTest extends TestCase
{
    /**
     * @return void
     */
    public function testCreateOfficialAccountEvent()
    {
        $this->assertInstanceOf(Event::class, WeChat::createOfficialAccountEvent([]));
    }
}
