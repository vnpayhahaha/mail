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

use Hyperf3Ext\Mail\Commands\GenMailCommand;
use Hyperf3Ext\Mail\Contracts\MailManagerInterface;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                MailManagerInterface::class => MailManager::class,
            ],
            'commands' => [
                GenMailCommand::class,
            ],
            'listeners' => [
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config for hyperf3-ext/mail.',
                    'source' => __DIR__ . '/../publish/mail.php',
                    'destination' => BASE_PATH . '/config/autoload/mail.php',
                ],
            ],
        ];
    }
}
