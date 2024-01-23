<?php

namespace Otomaties\PluginBoilerplate\Command\Contracts;

interface CommandContract
{
    public function handle(array $args, array $assocArgs): void;
}
