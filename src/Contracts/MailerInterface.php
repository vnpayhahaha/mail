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

interface MailerInterface
{
    /**
     * Render the given message as a view.
     */
    public function render(MailableInterface $mailable): string;

    /**
     * Send a new message using a mailable instance.
     */
    public function sendNow(MailableInterface $mailable): void;

    /**
     * Send a new message using a mailable instance.
     */
    public function send(MailableInterface $mailable): void;

    /**
     * Queue a new e-mail message for sending.
     */
    public function queue(MailableInterface $mailable, ?string $queue = null): bool;

    /**
     * Queue a new e-mail message for sending.
     */
    public function later(MailableInterface $mailable, int $delay, ?string $queue = null): bool;
}
