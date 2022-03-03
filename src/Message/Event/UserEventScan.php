<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Message\Event;

use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEventScan as Contract;
use HughCube\Laravel\WeChat\Models\QrScene;

class UserEventScan extends Event implements Contract
{
    public function getTicket(): ?string
    {
        return $this->getMessage('Ticket');
    }

    public function getScene(): ?QrScene
    {
        return QrScene::create($this->getMessage('EventKey'));
    }

    public function isSubscribe(): bool
    {
        return false;
    }
}
