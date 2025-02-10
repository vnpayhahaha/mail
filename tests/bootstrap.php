<?php

declare(strict_types=1);
/**
 * This file is part of hyperf3-ext/mail.
 *
 * @link     https://github.com/hyperf3-ext/mail
 * @contact  eric@zhu.email
 * @license  https://github.com/hyperf3-ext/mail/blob/master/LICENSE
 */
require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';

use Hyperf\Config\Config;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Utils\ApplicationContext;
use Hyperf3Ext\Mail\Contracts\MailManagerInterface;
use Hyperf3Ext\Mail\MailManager;
use Mockery as m;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;

$container = m::mock(ContainerInterface::class);
$container->shouldReceive('get')->with(EventDispatcherInterface::class)->andReturn(m::mock(EventDispatcherInterface::class));
$container->shouldReceive('get')->with(ConfigInterface::class)->andReturn(new Config([]));
$container->shouldReceive('get')->with(MailManagerInterface::class)->andReturn(new MailManager($container));

ApplicationContext::setContainer($container);
