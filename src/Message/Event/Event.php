<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 23:11
 */

namespace HughCube\Laravel\WeChat\Message\Event;

use Carbon\Carbon;
use Illuminate\Cache\ArrayStore;
use Illuminate\Cache\Repository;

class Event implements \HughCube\Laravel\WeChat\Contracts\Message\Event\Event
{
    /**
     * @var array
     */
    protected $message;

    /**
     * @var Repository
     */
    protected $store = null;

    /**
     * @param  array  $message
     */
    public function __construct(array $message = [])
    {
        $this->message = $message;
    }

    /**
     * @param  string|null  $key
     * @return array|mixed|null
     */
    public function getMessage(?string $key = null)
    {
        if (null === $key) {
            return $this->message;
        }

        return $this->message[$key] ?? null;
    }

    public function getToUserName(): ?string
    {
        return $this->getMessage('ToUserName');
    }

    public function getFromUserName(): ?string
    {
        return $this->getMessage('FromUserName');
    }

    public function getMessageType(): ?string
    {
        return $this->getMessage('MsgType');
    }

    public function getCreatedAt(): ?Carbon
    {
        $timestamp = $this->getMessage('CreateTime');
        if (empty($timestamp)) {
            return null;
        }
        return Carbon::createFromTimestamp($timestamp);
    }

    public function getMessageId(): ?int
    {
        return $this->getMessage('MsgId') ?: $this->getMessage('MsgID');
    }

    public function getEvent(): ?string
    {
        return $this->getMessage('Event');
    }

    public function getEventKey()
    {
        return $this->getMessage('EventKey');
    }

    public function getOpenID(): ?string
    {
        return $this->getFromUserName();
    }

    public function getStore(): Repository
    {
        if (null === $this->store) {
            $this->store = new Repository(new ArrayStore());
        }
        return $this->store;
    }
}
