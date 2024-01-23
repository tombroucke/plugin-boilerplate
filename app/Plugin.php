<?php 

namespace Otomaties\PluginBoilerplate;

use Illuminate\Support\Str;
use Illuminate\Container\Container;
use Otomaties\PluginBoilerplate\Modules\Admin;
use Otomaties\PluginBoilerplate\Helpers\Config;
use Otomaties\PluginBoilerplate\Helpers\Loader;
use Otomaties\PluginBoilerplate\Modules\Frontend;
use Otomaties\PluginBoilerplate\Command\CommandRegistrar;

class Plugin extends Container
{
    private array $modules = [
        Frontend::class,
        Admin::class,
    ];

    public function __construct(
        private Loader $loader,
        private Config $config
    ) {
    }

    public function config(string $key) : mixed
    {
        return $this->config->get($key);
    }

    public function initialize() : self
    {
        $this->loader->addAction('init', $this, 'loadTextDomain');

        $this->loadModules();
        $this->initCommands();
        $this->initPostTypes();
        $this->initOptionsPages();

        return $this;
    }

    private function initCommands()
    {
        $this->make(CommandRegistrar::class)
            ->register();
    }

    private function initPostTypes()
    {
        collect([
            'PostTypes',
            'Taxonomies',
        ])->each(function ($registerableClassPath) {
            $this
                ->collectFilesIn("$registerableClassPath")
                ->each(function ($filename) {
                    $className = $this->namespacedClassNameFromFilename($filename);
                    $this->loader->addAction('init', new $className(), 'register');
                });
        });
    }

    private function initOptionsPages()
    {
        $this
            ->collectFilesIn('OptionsPages')
            ->each(function ($filename) {
                $className = $this->namespacedClassNameFromFilename($filename);
                $this->loader->addAction('acf/init', new $className(), 'register');
            });
    }

    private function loadModules() : self
    {
        collect($this->modules)
            ->each(function ($className) {
                ($this->make($className))
                    ->init();
            });
        return $this;
    }

    public function loadTextDomain() : void
    {
        load_plugin_textdomain(
            'plugin-boilerplate',
            false,
            basename($this->config('paths.base')) . '/resources/languages'
        );
    }

    public function getLoader() : Loader
    {
        return $this->loader;
    }

    public function runLoader() : void
    {
        apply_filters('plugin_boilerplate_loader', $this->getLoader())
            ->run();
    }
    
    private function collectFilesIn($path)
    {
        $fullPath = $this->config('paths.app') . "/$path";
        return collect(array_merge(
            glob("$fullPath/*.php"),
            glob("$fullPath/**/*.php")
        ))
        ->reject(function ($filename) {
            return Str::contains($filename, 'Example');
        })
        ->reject(function ($filename) {
            return Str::contains($filename, '/Abstracts') || Str::contains($filename, '/Traits') || Str::contains($filename, '/Contracts');
        });
    }
    
    private function namespacedClassNameFromFilename($filename)
    {
        return Str::of($filename)
            ->replace($this->config('paths.app'), '')
            ->ltrim('/')
            ->replace('/', '\\')
            ->rtrim('.php')
            ->prepend('\\' . __NAMESPACE__. '\\')
            ->__toString();
    }
}
