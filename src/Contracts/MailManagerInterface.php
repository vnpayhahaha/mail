<?php

declare(strict_types=1);
/**
 * This file is part of hyperf3-ext/mail.
 *
 * @link     https://github.com/hyperf3-ext/mail
 * @contact  eric@zhu.email
 * @license  https://github.com/hyperf3-ext/mail/blob/master/LICENSE
 */
namespace Hyperf3Ext\Mail\Contracts;

interface MailManagerInterface
{
    /**
     * Get a mailer instance by name.
     */
    public function get(string $name): MailerInterface;
}
