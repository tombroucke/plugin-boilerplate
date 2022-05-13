<?php

namespace Otomaties\PluginBoilerplate;

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @subpackage PluginBoilerplate/public
 */

class Frontend
{

    /**
     * The ID of this plugin.
     *
     * @var      string    $pluginName    The ID of this plugin.
     */
    private string $pluginName;

    /**
     * The version of this plugin.
     *
     * @var      string    $version    The current version of this plugin.
     */
    private string $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param      string    $pluginName       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct(string $pluginName, string $version)
    {

        $this->pluginName = $pluginName;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     */
    public function enqueueStyles() : void
    {
        wp_enqueue_style($this->pluginName, Assets::find('css/main.css'), array(), null);
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     */
    public function enqueueScripts() : void
    {
        wp_enqueue_script($this->pluginName, Assets::find('js/main.js'), array( 'jquery' ), null);
    }
}
