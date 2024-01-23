<?php

namespace Otomaties\PluginBoilerplate\OptionsPages;

use Otomaties\PluginBoilerplate\OptionsPages\Abstracts\OptionsPage as AbstractsOptionsPage;
use Otomaties\PluginBoilerplate\OptionsPages\Contracts\OptionsPage;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Options extends AbstractsOptionsPage implements OptionsPage
{
    protected string $slug = 'plugin-boilerplate-settings';

    protected string $title = 'Plugin Boilerplate Settings';

    protected string $menuTitle = 'Plugin Boilerplate Settings';

    public function __construct()
    {
        $this->title = __('Plugin Boilerplate Settings', 'plugin-boilerplate');
        $this->menuTitle = __('Plugin Boilerplate Settings', 'plugin-boilerplate');
    }

    protected function fields(FieldsBuilder $fieldsBuilder) : FieldsBuilder
    {
        $fieldsBuilder
            ->addText('foo', [
                'label' => __('Foo', 'plugin-boilerplate'),
                'default_value' => 'bar',
            ]);
        return $fieldsBuilder;
    }
}
