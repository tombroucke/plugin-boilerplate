<?php

namespace Otomaties\PluginBoilerplate\Modules;

use Otomaties\PluginBoilerplate\Models\Book;
use Otomaties\PluginBoilerplate\Modules\Abstracts\Module;

class Frontend extends Module
{
    public function init()
    {
        // $this->loader->addAction('wp_enqueue_scripts', $this, 'enqueueScripts');
    }

    // public function enqueueScripts()
    // {
    //     if (property_exists($this->assets->entrypoints()->app, 'js')) {
    //         foreach ($this->assets->entrypoints()->app->js as $js) {
    //             wp_enqueue_script('plugin-boilerplate-app-' . $js, $this->assets->url($js), [], null, true);
    //         }
    //     }
        
    //     if (property_exists($this->assets->entrypoints()->app, 'css')) {
    //         foreach ($this->assets->entrypoints()->app->css as $css) {
    //             wp_enqueue_style('plugin-boilerplate-app-' . $css, $this->assets->url($css), [], null);
    //         }
    //     }
    // }
}
