<?php

use Otomaties\PluginBoilerplate\Plugin;
use Otomaties\PluginBoilerplate\Helpers\View;
use Otomaties\PluginBoilerplate\Helpers\Assets;
use Otomaties\PluginBoilerplate\Helpers\Config;
use Otomaties\PluginBoilerplate\Helpers\Loader;

/**
 * Plugin Name:       WordPress Plugin Boilerplate
 * Plugin URI:        http://example.com/plugin-boilerplate-uri/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Tom Broucke
 * Author URI:        https://tombroucke.be/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       plugin-boilerplate
 * Domain Path:       /resources/languages
 */

/**
 * Get main plugin class instance
 *
 * @return Plugin
 */
function pluginBoilerplate()
{
    static $plugin;

    if (!$plugin) {
        $plugin = new Plugin(
            new Loader(),
            new Config()
        );
        do_action('plugin_boilerplate_functionality', $plugin);
    }

    return $plugin;
}

// Bind the class to the service container
add_action('plugin_boilerplate_functionality', function ($plugin) {
    $plugin->bind(Loader::class, function ($plugin) {
        return $plugin->getLoader();
    });
    $plugin->bind(View::class, function ($plugin) {
        return new View($plugin->config('paths.views'));
    });
    $plugin->bind(Assets::class, function ($plugin) {
        return new Assets($plugin->config('paths.public'));
    });
}, 10);

// Initialize the plugin and run the loader
add_action('plugin_boilerplate_functionality', function ($plugin) {
    $plugin
        ->initialize()
        ->runLoader();
}, 9999);

pluginBoilerplate();
