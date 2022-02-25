<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/25
 * Time: 14:42
 */

namespace HughCube\Laravel\WeChat;

use HughCube\Laravel\WeChat\Contracts\Message;
use HughCube\Laravel\WeChat\Message\Event\TemplateMessageEventSendJobFinish;
use HughCube\Laravel\WeChat\Message\Event\UserEventLocation;
use HughCube\Laravel\WeChat\Message\Event\UserEventMenuClickButton;
use HughCube\Laravel\WeChat\Message\Event\UserEventMenuClickView;
use HughCube\Laravel\WeChat\Message\Event\UserEventScan;
use HughCube\Laravel\WeChat\Message\Event\UserEventSubscribe;
use HughCube\Laravel\WeChat\Message\Event\UserEventSubscribeWithScan;
use HughCube\Laravel\WeChat\Message\Event\UserEventUnsubscribe;
use HughCube\Laravel\WeChat\Message\Event\UserMessageImage;
use HughCube\Laravel\WeChat\Message\Event\UserMessageLink;
use HughCube\Laravel\WeChat\Message\Event\UserMessageLocation;
use HughCube\Laravel\WeChat\Message\Event\UserMessageShortVideo;
use HughCube\Laravel\WeChat\Message\Event\UserMessageText;
use HughCube\Laravel\WeChat\Message\Event\UserMessageVideo;
use HughCube\Laravel\WeChat\Message\Event\UserMessageVoice;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    public function boot()
    {
        foreach ($this->getBindings() as $abstract => $concrete) {
            if ($this->app->bound($abstract)) {
                continue;
            }
            $this->app->bind($abstract, $concrete);
        }
    }

    protected function getBindings(): array
    {
        return [
            /** 用户发送的消息 */
            Message\Event\UserMessageText::class => UserMessageText::class,
            Message\Event\UserMessageImage::class => UserMessageImage::class,
            Message\Event\UserMessageVoice::class => UserMessageVoice::class,
            Message\Event\UserMessageVideo::class => UserMessageVideo::class,
            Message\Event\UserMessageShortVideo::class => UserMessageShortVideo::class,
            Message\Event\UserMessageLocation::class => UserMessageLocation::class,
            Message\Event\UserMessageLink::class => UserMessageLink::class,

            /** 用户行为事件 */
            Message\Event\UserEventLocation::class => UserEventLocation::class,
            Message\Event\UserEventMenuClickButton::class => UserEventMenuClickButton::class,
            Message\Event\UserEventMenuClickView::class => UserEventMenuClickView::class,
            Message\Event\UserEventScan::class => UserEventScan::class,
            Message\Event\UserEventSubscribe::class => UserEventSubscribe::class,
            Message\Event\UserEventSubscribeWithScan::class => UserEventSubscribeWithScan::class,
            Message\Event\UserEventUnsubscribe::class => UserEventUnsubscribe::class,

            /** 模版消息 */
            Message\Event\TemplateMessageEventSendJobFinish::class => TemplateMessageEventSendJobFinish::class,
        ];
    }
}
