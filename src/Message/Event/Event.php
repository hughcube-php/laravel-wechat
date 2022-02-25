<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 23:11
 */

namespace HughCube\Laravel\WeChat\Message\Event;

use Carbon\Carbon;

class Event implements \HughCube\Laravel\WeChat\Contracts\Message\Event\Event
{
    /**
     * @var array
     */
    protected array $message;

    /**
     * @param  array  $message
     */
    public function __construct(array $message = [])
    {
        $this->message = $message;
    }

    public function getMessage(null|int|string $key = null): mixed
    {
        if (null === $key) {
            return $this->message;
        }

        return $this->message[$key] ?? null;
    }

    public function getToUserName(): null|string
    {
        return $this->getMessage('ToUserName');
    }

    public function getFromUserName(): null|string
    {
        return $this->getMessage('FromUserName');
    }

    public function getMessageType(): null|string
    {
        return $this->getMessage('MsgType');
    }

    public function getCreatedAt(): null|Carbon
    {
        $timestamp = $this->getMessage('CreateTime');
        if (empty($timestamp)) {
            return null;
        }
        return Carbon::createFromTimestamp($timestamp);
    }

    public function getMessageId(): null|float|int
    {
        return $this->getMessage('MsgId') ?: $this->getMessage('MsgID');
    }

    public function getEvent(): null|string
    {
        return $this->getMessage('Event');
    }

    public function getEventKey(): null|string
    {
        return $this->getMessage('EventKey');
    }

    public function getOpenID(): null|string
    {
        return $this->getFromUserName();
    }
}
