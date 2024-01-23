<?php

namespace Otomaties\PluginBoilerplate\Modules\Abstracts;

use Otomaties\PluginBoilerplate\Helpers\View;
use Otomaties\PluginBoilerplate\Helpers\Loader;
use Otomaties\PluginBoilerplate\Helpers\Assets;

abstract class Module
{
    public function __construct(
        protected Loader $loader,
        protected View $view,
        protected Assets $assets,
    ) {
    }

    abstract public function init();
}
