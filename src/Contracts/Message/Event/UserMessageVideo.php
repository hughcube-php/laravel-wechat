<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Contracts\Message\Event;

interface UserMessageVideo extends UserMessage
{
    /**
     * 视频消息缩略图的媒体id，可以调用多媒体文件下载接口拉取数据。
     * @return string|null
     */
    public function getThumbMediaId(): null|string;

    /**
     * 视频消息媒体id，可以调用获取临时素材接口拉取数据。
     *
     * @return string|null
     */
    public function getMediaId(): null|string;
}
