<?php

namespace Calchen\LaravelDingtalkRobot\Message;

use Calchen\LaravelDingtalkRobot\Exception\InvalidArgumentException;

/**
 * 文本类型消息
 *
 * Class DingtalkTextMessage
 * @package Calchen\LaravelDingtalkRobot
 */
class TextMessage extends Message
{
    /**
     * DingtalkTextMessage constructor.
     *
     * @param string $content 消息内容
     */
    public function __construct(string $content)
    {
        $this->setMessage($content);
    }

    /**
     * @param string $content 消息内容
     */
    public function setMessage(string $content): void
    {
        $this->message = [
            'msgtype' => 'text',
            'text' => [
                'content' => $content
            ]
        ];
    }

    /**
     * 通过手机号码指定“被@人列表”
     *
     * @param string|array $mobiles 被@人的手机号(在text内容里要有@手机号)
     * @param bool         $atAll   @所有人时:true,否则为:false
     *
     * @return Message
     * @throws InvalidArgumentException
     */
    public function at($mobiles, bool $atAll = false): self
    {
        if (!is_array($mobiles) && !is_string($mobiles)) {
            throw new InvalidArgumentException('$mobiles should be string or array');
        }
        if (!is_array($mobiles)) {
            $mobiles = [$mobiles];
        }

        $this->at = [
            'at' => [
                'atMobiles' => $mobiles,
                'isAtAll' => $atAll
            ]
        ];

        return $this;
    }
}