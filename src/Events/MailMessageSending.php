<?php

declare(strict_types=1);
/**
 * This file is part of hyperf3-ext/mail.
 *
 * @link     https://github.com/hyperf3-ext/mail
 * @contact  eric@zhu.email
 * @license  https://github.com/hyperf3-ext/mail/blob/master/LICENSE
 */
namespace Hyperf3Ext\Mail\Events;

use Symfony\Component\Mime\Email;

class MailMessageSending
{
    /**
     * The Swift message instance.
     */
    public Email $message;

    /**
     * The message data.
     */
    public array $data;

    /**
     * Create a new event instance.
     */
    public function __construct(Email $message, array $data = [])
    {
        $this->data = $data;
        $this->message = $message;
    }
}
