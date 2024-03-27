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
use Illuminate\Support\Str;

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

    public function getStore(): Repository
    {
        if (null === $this->store) {
            $this->store = new Repository(new ArrayStore());
        }
        return $this->store;
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

    public function getOpenID(): ?string
    {
        return $this->getFromUserName();
    }

    public function getContent($trim = true): ?string
    {
        $content = $this->getMessage('Content');

        if (null === $content) {
            return null;
        }

        return $trim ? trim($content) : $content;
    }

    public function contentIs($pattern, $trim = true): bool
    {
        return Str::is($pattern, $this->getContent($trim) ?? '');
    }

    public function contentEq($string, bool $trim = true): bool
    {
        return $string === $this->getContent($trim);
    }

    public function contentContains($needles, $ignoreCase = false, $trim = true): bool
    {
        return Str::contains($this->getContent($trim) ?? '', $needles, $ignoreCase);
    }

    public function contentStartsWith($needles, $trim = true): bool
    {
        return Str::startsWith($this->getContent($trim) ?? '', $needles);
    }

    public function contentEndsWith($needles, $trim = true): bool
    {
        return Str::endsWith($this->getContent($trim) ?? '', $needles);
    }

    public function getEventKey()
    {
        return $this->getMessage('EventKey');
    }

    public function eventKeyIs($pattern): bool
    {
        return Str::is($pattern, $this->getEventKey() ?? '');
    }

    public function eventKeyEq($key): bool
    {
        return $key === $this->getEventKey();
    }

    public function eventKeyContains($needles, $ignoreCase = false, $trim = true): bool
    {
        return Str::contains($this->getEventKey() ?? '', $needles, $ignoreCase);
    }

    public function eventKeyStartsWith($needles, $trim = true): bool
    {
        return Str::startsWith($this->getEventKey() ?? '', $needles);
    }

    public function eventKeyEndsWith($needles, $trim = true): bool
    {
        return Str::endsWith($this->getEventKey() ?? '', $needles);
    }
}
