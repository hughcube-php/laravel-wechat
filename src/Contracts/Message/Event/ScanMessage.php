<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Contracts\Message\Event;

interface ScanMessage
{
    public function isSubscribe(): bool;

    public function getScene(): ?string;

    public function getTicket(): ?string;
}
