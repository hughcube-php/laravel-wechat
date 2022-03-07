<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Contracts\Message\Event;

use HughCube\Laravel\WeChat\Model\QrScene;

interface ScanMessage
{
    public function isSubscribe(): bool;

    public function getScene(): ?QrScene;

    public function getTicket(): ?string;
}
