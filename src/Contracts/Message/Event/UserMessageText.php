<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Contracts\Message\Event;

interface UserMessageText extends UserMessage, LinkMessage
{
    /**
     * 文本消息内容
     * @param  bool  $trim
     * @return string
     */
    public function getContent(bool $trim = true): string;

    public function is($pattern, $trim = true): bool;

    public function eq($string, $trim = true): bool;

    public function contains($needles, $ignoreCase = false, $trim = true): bool;
}
