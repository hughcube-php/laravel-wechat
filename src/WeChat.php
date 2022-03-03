<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/4/20
 * Time: 4:21 下午.
 */

namespace HughCube\Laravel\WeChat;

use App\Enum\WeChatQrSceneType;
use HughCube\Laravel\WeChat\Contracts\Message\Event\Event;
use HughCube\Laravel\WeChat\Contracts\Message\Event\TemplateMessageEventSendJobFinish;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEventLocation;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEventMenuClickButton;
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
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Str;

class WeChat extends \Overtrue\LaravelWeChat\Facade
{
    /**
     * @param  array  $message
     * @return Event|null
     * @throws BindingResolutionException
     */
    public static function createOfficialAccountEvent(array $message): ?Event
    {
        $type = $message['MsgType'] ?? '';
        $event = $message['Event'] ?? '';
        $eventKey = $message['EventKey'] ?? '';

        /** 用户发送的消息 */
        if ('text' === $type) {
            return static::$app->make(UserMessageText::class, ['message' => $message]);
        } elseif ('image' === $type) {
            return static::$app->make(UserMessageImage::class, ['message' => $message]);
        } elseif ('voice' === $type) {
            return static::$app->make(UserMessageVoice::class, ['message' => $message]);
        } elseif ('video' === $type) {
            return static::$app->make(UserMessageVideo::class, ['message' => $message]);
        } elseif ('shortvideo' === $type) {
            return static::$app->make(UserMessageShortVideo::class, ['message' => $message]);
        } elseif ('location' === $type) {
            return static::$app->make(UserMessageLocation::class, ['message' => $message]);
        } elseif ('link' === $type) {
            return static::$app->make(UserMessageLink::class, ['message' => $message]);
        }

        /** 用户行为事件 */
        if ('event' === $type && $event === 'subscribe' && Str::startsWith($eventKey, 'qrscene_')) {
            return static::$app->make(UserEventSubscribeWithScan::class, ['message' => $message]);
        } elseif ('event' === $type && $event === 'subscribe') {
            return static::$app->make(UserEventSubscribe::class, ['message' => $message]);
        } elseif ('event' === $type && $event === 'unsubscribe') {
            return static::$app->make(UserEventUnsubscribe::class, ['message' => $message]);
        } elseif ('event' === $type && $event === 'SCAN') {
            return static::$app->make(UserEventScan::class, ['message' => $message]);
        } elseif ('event' === $type && $event === 'unsubscribe') {
            return static::$app->make(UserEventUnsubscribe::class, ['message' => $message]);
        } elseif ('event' === $type && $event === 'LOCATION') {
            return static::$app->make(UserEventLocation::class, ['message' => $message]);
        } elseif ('event' === $type && $event === 'CLICK') {
            return static::$app->make(UserEventMenuClickButton::class, ['message' => $message]);
        } elseif ('event' === $type && $event === 'VIEW') {
            return static::$app->make(UserEventMenuClickView::class, ['message' => $message]);
        }

        /** 模版消息 */
        if ('event' === $type && $event === 'TEMPLATESENDJOBFINISH') {
            return static::$app->make(TemplateMessageEventSendJobFinish::class, ['message' => $message]);
        }

        return null;
    }
}
