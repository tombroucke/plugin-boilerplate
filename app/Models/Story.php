<?php
namespace Otomaties\PluginBoilerplate\Models;

use Otomaties\WpModels\PostType;

class Story extends PostType
{
    public static function postType() : string
    {
        return 'story';
    }
}
