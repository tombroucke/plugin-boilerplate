<?php

namespace Otomaties\PluginBoilerplate\Models;

use Otomaties\PluginBoilerplate\Models\Abstracts\Post;

class Book extends Post
{
    public static function postType() : string
    {
        return 'book';
    }
}
