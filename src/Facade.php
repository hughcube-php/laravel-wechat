<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/5/19
 * Time: 17:28
 */

namespace HughCube\Laravel\WeChat;

use Overtrue\LaravelWeChat\EasyWeChat;
use Overtrue\LaravelWeChat\Facade as EasyWeChatFacade;

if (class_exists(EasyWeChat::class)) {
    class Facade extends EasyWeChat
    {
    }
} else {
    class Facade extends EasyWeChatFacade
    {
    }
}
