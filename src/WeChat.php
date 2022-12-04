<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/4/20
 * Time: 4:21 下午.
 */

namespace HughCube\Laravel\WeChat;

use HughCube\Laravel\WeChat\Contracts\Message\Event\Event;
use HughCube\Laravel\WeChat\Contracts\Message\Event\TemplateMessageEventSendJobFinish;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEventLocation;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEventMenuClickButton;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEventMenuClickMiniProgram;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEventMenuClickView;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEventScan;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEventSubscribe;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEventSubscribeWithScan;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEventUnsubscribe;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserMessageImage;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserMessageLink;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserMessageLocation;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserMessageShortVideo;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserMessageText;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserMessageVideo;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserMessageVoice;
use Illuminate\Support\Str;
use Overtrue\LaravelWeChat\EasyWeChat;
use Overtrue\LaravelWeChat\Facade as EasyWeChatFacade;

/**
 * @mixin EasyWeChat
 * @mixin EasyWeChatFacade
 * @phpstan-ignore-next-line
 */
class WeChat extends Facade
{
    /**
     * @param  array  $message
     * @return Event
     * @throws
     * @phpstan-ignore-next-line
     */
    public static function createOfficialAccountEvent(array $message): Event
    {
        $type = $message['MsgType'] ?? '';
        $event = $message['Event'] ?? '';
        $eventKey = $message['EventKey'] ?? '';

        /** 用户发送的消息 */
        if ('text' === $type) {
            $abstract = UserMessageText::class;
        } elseif ('image' === $type) {
            $abstract = UserMessageImage::class;
        } elseif ('voice' === $type) {
            $abstract = UserMessageVoice::class;
        } elseif ('video' === $type) {
            $abstract = UserMessageVideo::class;
        } elseif ('shortvideo' === $type) {
            $abstract = UserMessageShortVideo::class;
        } elseif ('location' === $type) {
            $abstract = UserMessageLocation::class;
        } elseif ('link' === $type) {
            $abstract = UserMessageLink::class;
        } elseif ('event' === $type && $event === 'subscribe' && Str::startsWith($eventKey, 'qrscene_')) {
            $abstract = UserEventSubscribeWithScan::class;
        } elseif ('event' === $type && $event === 'subscribe') {
            $abstract = UserEventSubscribe::class;
        } elseif ('event' === $type && $event === 'unsubscribe') {
            $abstract = UserEventUnsubscribe::class;
        } elseif ('event' === $type && $event === 'SCAN') {
            $abstract = UserEventScan::class;
        } elseif ('event' === $type && $event === 'unsubscribe') {
            $abstract = UserEventUnsubscribe::class;
        } elseif ('event' === $type && $event === 'LOCATION') {
            $abstract = UserEventLocation::class;
        } elseif ('event' === $type && $event === 'CLICK') {
            $abstract = UserEventMenuClickButton::class;
        } elseif ('event' === $type && $event === 'VIEW') {
            $abstract = UserEventMenuClickView::class;
        } elseif ('event' === $type && $event === 'view_miniprogram') {
            $abstract = UserEventMenuClickMiniProgram::class;
        } elseif ('event' === $type && $event === 'TEMPLATESENDJOBFINISH') {
            $abstract = TemplateMessageEventSendJobFinish::class;
        } else {
            $abstract = Event::class;
        }

        /** 已经绑定实现类 */
        if (static::$app->bound($abstract)) {
            return static::$app->make($abstract, ['message' => $message]);
        }

        /** 尝试使用默认实现类 */
        $concrete = strtr($abstract, ['\Contracts' => '']);
        if (class_exists($concrete)) {
            return static::$app->make($concrete, ['message' => $message]);
        }

        /** 兜底使用基类 */
        return static::$app->make(Message\Event\Event::class, ['message' => $message]);
    }
}
