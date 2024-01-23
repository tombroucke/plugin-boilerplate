<?php

namespace Otomaties\PluginBoilerplate\PostTypes\Contracts;

use ExtCPTs\PostType as ExtCPTsPostType;

interface PostType
{
    public function register() : ExtCPTsPostType;
}
