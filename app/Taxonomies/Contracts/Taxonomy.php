<?php

namespace Otomaties\PluginBoilerplate\Taxonomies\Contracts;

use ExtCPTs\Taxonomy as ExtCPTsTaxonomy;

interface Taxonomy
{
    public function register() : ExtCPTsTaxonomy;
}
