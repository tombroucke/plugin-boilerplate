<?php

namespace Otomaties\PluginBoilerplate\Command;

use Otomaties\PluginBoilerplate\Plugin;
use Otomaties\PluginBoilerplate\Command\FooCommand;

class CommandRegistrar
{
    protected array $commands = [
        FooCommand::class,
    ];

    public function __construct(public Plugin $plugin)
    {
    }

    public function register()
    {
        if (!defined('WP_CLI') || !WP_CLI) {
            return;
        }

        foreach ($this->commands as $commandClass) {
            \WP_CLI::add_command(
                $commandClass::COMMAND_NAME,
                function ($args, $assocArgs) use ($commandClass) {
                    $commandInstance = $this->plugin->make($commandClass);
                    $commandInstance->handle($args, $assocArgs);
                },
                [
                'shortdesc' => $commandClass::COMMAND_DESCRIPTION,
                'synopsis' => $commandClass::COMMAND_ARGUMENTS,
                ]
            );
        }
    }
}
