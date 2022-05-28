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
use Illuminate\Support\Str;

class UserMessageText extends Event implements Contract
{
    public function getContent($trim = true): string
    {
        $content = $this->getMessage('Content');

        return $trim ? trim($content) : $content;
    }

    public function is($pattern, $trim = true): bool
    {
        return Str::is($pattern, $this->getContent($trim));
    }

    public function eq($string, $trim = true): bool
    {
        return $string === $this->getContent($trim);
    }

    public function contains($needles, $ignoreCase = false, $trim = true): bool
    {
        return Str::contains($this->getContent($trim), $needles, $ignoreCase);
    }

    public function getUrl(): ?HUrl
    {
        return HUrl::parse($this->getContent());
    }
}
