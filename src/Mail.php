<?php

declare(strict_types=1);
/**
 * This file is part of hyperf3-ext/mail.
 *
 * @link     https://github.com/hyperf3-ext/mail
 * @contact  eric@zhu.email
 * @license  https://github.com/hyperf3-ext/mail/blob/master/LICENSE
 */
namespace Hyperf3Ext\Mail;

use Hyperf\Context\ApplicationContext;
use Hyperf3Ext\Mail\Contracts\MailManagerInterface;

/**
 * @method static \Hyperf3Ext\Mail\PendingMail to(mixed $users)
 * @method static \Hyperf3Ext\Mail\PendingMail cc(mixed $users)
 * @method static \Hyperf3Ext\Mail\PendingMail bcc(mixed $users)
 * @method static bool later(\Hyperf3Ext\Mail\Contracts\MailableInterface $mailable, int $delay, ?string $queue = null)
 * @method static bool queue(\Hyperf3Ext\Mail\Contracts\MailableInterface $mailable, ?string $queue = null)
 * @method static null|int send(\Hyperf3Ext\Mail\Contracts\MailableInterface $mailable)
 *
 * @see \Hyperf3Ext\Mail\MailManager
 */
abstract class Mail
{
    public static function __callStatic(string $method, array $args)
    {
        $instance = static::getManager();

        return $instance->{$method}(...$args);
    }

    public static function mailer(string $name): PendingMail
    {
        return new PendingMail(static::getManager()->get($name));
    }

    protected static function getManager(): MailManagerInterface
    {
        return ApplicationContext::getContainer()->get(MailManagerInterface::class);
    }
}
