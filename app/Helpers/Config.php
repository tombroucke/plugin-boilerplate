<?php

namespace Otomaties\PluginBoilerplate\Helpers;

use Illuminate\Config\Repository;

class Config extends Repository
{
    public function __construct()
    {
        $this->items = $this->loadConfig();
    }

    private function loadConfig() : array
    {
        return collect(glob(plugin_dir_path(__FILE__) . '../../config/*.php'))
            ->mapWithKeys(function ($configFile) {
                $key = basename($configFile, '.php');
                return [$key => require $configFile];
            })
            ->toArray();
    }
}

