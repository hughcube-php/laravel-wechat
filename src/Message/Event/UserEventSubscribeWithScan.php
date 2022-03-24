<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Message\Event;

use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEventSubscribeWithScan as Contract;
use HughCube\Laravel\WeChat\Model\QrScene;

class UserEventSubscribeWithScan extends Event implements Contract
{
    public function isScan(): bool
    {
        return true;
    }

    public function getTicket(): ?string
    {
        return $this->getMessage('Ticket');
    }

    public function getScene(): ?QrScene
    {
        return QrScene::create($this->getEventKey());
    }

    public function isSubscribe(): bool
    {
        return true;
    }
}
