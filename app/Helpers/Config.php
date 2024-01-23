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
        $config = [];
        $configFiles = glob(plugin_dir_path(__FILE__) . '../../config/*.php');
        foreach ($configFiles as $configFile) {
            $key = basename($configFile, '.php');
            $config[$key] = require $configFile;
        }
        return $config;
    }
}
