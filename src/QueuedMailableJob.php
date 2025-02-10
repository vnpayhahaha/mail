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

use Hyperf\AsyncQueue\Job;
use Hyperf\Context\ApplicationContext;
use Hyperf3Ext\Mail\Contracts\MailableInterface;
use Hyperf3Ext\Mail\Contracts\MailManagerInterface;
use function Hyperf\Config\config;

class QueuedMailableJob extends Job
{
    protected string $queue;

    public function __construct(public MailableInterface $mailable)
    {
        $this->queue = (property_exists($mailable, 'queue') ? $mailable->queue : array_key_first(config('async_queue')));
    }

    public function handle(): void
    {
        $this->mailable->send(ApplicationContext::getContainer()->get(MailManagerInterface::class));
    }
}
