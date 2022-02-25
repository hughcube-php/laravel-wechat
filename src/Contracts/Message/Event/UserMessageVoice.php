<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Contracts\Message\Event;

interface UserMessageVoice extends UserMessage
{
    /**
     * 语音格式，如amr，speex等
     * @return string|null
     */
    public function getFormat(): null|string;

    /**
     * 视频消息媒体id，可以调用获取临时素材接口拉取数据。
     *
     * @return string|null
     */
    public function getMediaId(): null|string;

    /**
     * 请注意，开通语音识别后，用户每次发送语音给公众号时，
     * 微信会在推送的语音消息XML数据包中，增加一个Recognition字段
     * 注：由于客户端缓存，开发者开启或者关闭语音识别功能，对新关注者立刻生效，
     * 对已关注用户需要24小时生效。开发者可以重新关注此帐号进行测试）。
     * 语音识别结果，UTF8编码
     * @return string|null
     */
    public function getRecognition(): null|string;
}
