<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Contracts\Message\Event;

interface UserMessageImage extends UserMessage
{
    /**
     * 图片链接（由系统生成）
     *
     * @return string|null
     */
    public function getPicUrl(): null|string;

    /**
     * 图片消息媒体id，可以调用获取临时素材接口拉取数据。
     *
     * @return string|null
     */
    public function getMediaId(): null|string;
}
