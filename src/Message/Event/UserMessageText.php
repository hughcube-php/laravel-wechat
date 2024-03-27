<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Message\Event;

use HughCube\Laravel\WeChat\Contracts\Message\Event\UserMessageText as Contract;
use HughCube\PUrl\HUrl;

class UserMessageText extends Event implements Contract
{
    /**
     * @deprecated
     * @see static::contentIs()
     */
    public function is($pattern, $trim = true): bool
    {
        return $this->contentIs($pattern, $trim);
    }

    /**
     * @deprecated
     * @see static::contentEq()
     */
    public function eq($string, $trim = true): bool
    {
        return $this->contentEq($string, $trim);
    }

    /**
     * @deprecated
     * @see static::contentContains()
     */
    public function contains($needles, $ignoreCase = false, $trim = true): bool
    {
        return $this->contentContains($needles, $ignoreCase, $trim);
    }

    public function getUrl(): ?HUrl
    {
        return HUrl::parse($this->getContent());
    }
}
