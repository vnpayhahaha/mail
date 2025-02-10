<?php

declare(strict_types=1);
/**
 * This file is part of hyperf3-ext/mail.
 *
 * @link     https://github.com/hyperf3-ext/mail
 * @contact  eric@zhu.email
 * @license  https://github.com/hyperf3-ext/mail/blob/master/LICENSE
 */
namespace HyperfTest\Mail;

use Hyperf\Config\Config;
use Hyperf\Contract\ConfigInterface;
use Hyperf3Ext\Mail\Contracts\MailManagerInterface;
use Hyperf3Ext\Mail\MailManager;
use Mockery as m;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * @internal
 * @coversNothing
 */
class MailManagerTest extends TestCase
{
    public function testEmptyTransportConfig()
    {
        $container = m::mock(ContainerInterface::class);
        $container->shouldReceive('get')->with(EventDispatcherInterface::class)->andReturn(m::mock());
        $container->shouldReceive('get')->with(ConfigInterface::class)->andReturn(new Config([
            'mail' => [
                'mailers' => [
                    'custom_smtp' => [
                        'dsn' => '',
                    ],
                ],
            ],
        ]));
        $container->shouldReceive('get')->with(MailManagerInterface::class)->andReturn(new MailManager($container));

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The mail transport must be specified.');
        $container->get(MailManagerInterface::class)->mailer('custom_smtp');
    }
}
