<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Message\Event;

use Illuminate\Support\Str;
use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEventSubscribeWithScan as Contract;

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

    public function getScene(): ?string
    {
        $eventKey = $this->getEventKey();
        return is_string($eventKey) ? Str::afterLast($eventKey, 'qrscene_') : null;
    }

    public function isSubscribe(): bool
    {
        return true;
    }
}
