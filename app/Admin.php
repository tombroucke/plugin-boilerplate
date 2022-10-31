<?php

namespace Otomaties\PluginBoilerplate;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @subpackage PluginBoilerplate/admin
 */

class Admin
{

    /**
     * Initialize the class and set its properties.
     *
     * @param      string    $pluginName       The name of this plugin.
     */
    public function __construct(private string $pluginName)
    {
    }

    /**
     * Register the stylesheets for the admin area.
     *
     */
    public function enqueueStyles() : void
    {
        wp_enqueue_style($this->pluginName, Assets::find('css/admin.css'), [], null, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     */
    public function enqueueScripts() : void
    {
        wp_enqueue_script($this->pluginName, Assets::find('js/admin.js'), [], null, true);
    }
}
