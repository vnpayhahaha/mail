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
use Pudongping\HyperfWiseLocksmith\Locker;
use Pudongping\WiseLocksmith\Exception\MutexException;

class QueuedMailableJob extends Job
{
    private Locker $locker;

    public function __construct(public MailableInterface $mailable)
    {
        // 判断 $this->locker是否初始化，如果未初始化，则初始化
        if (!$this->locker instanceof Locker) {
            $this->locker = ApplicationContext::getContainer()->get(Locker::class);
        }

    }

    public function handle(): void
    {
        $mailable = $this->mailable;
        try {
            $this->locker->redisLock('email_send_lock', function () use ($mailable) {
                $mailable->send(ApplicationContext::getContainer()->get(MailManagerInterface::class));
            }, 10);
        } catch (MutexException|\Throwable $e) {
            var_dump('=========== Email Throwable =============', $e->getMessage());
        }

    }
}
