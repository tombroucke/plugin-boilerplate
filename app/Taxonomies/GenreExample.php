<?php

namespace Otomaties\PluginBoilerplate\Taxonomies;

use ExtCPTs\Taxonomy as ExtCPTsTaxonomy;
use Otomaties\PluginBoilerplate\Helpers\Labels;
use Otomaties\PluginBoilerplate\Taxonomies\Contracts\Taxonomy;
use Otomaties\PluginBoilerplate\Exceptions\ExtendedCptsNotInstalledException;

class Genre implements Taxonomy
{
    const TAXONOMY = 'genre';
    const POST_TYPE = 'book';

    public function register() : ExtCPTsTaxonomy
    {
        if (!function_exists('register_extended_taxonomy')) {
            throw new ExtendedCptsNotInstalledException();
        }

        $taxonomySingularName = __('Genre', 'functionality-plugin');
        $taxonomyPluralName = __('Genres', 'functionality-plugin');

        $args = [
            'meta_box' => 'radio', // can be null, 'simple', 'radio', 'dropdown'
            'exclusive' => false, // true means: just one can be selected; only for simple
            'labels' => Labels::taxonomy($taxonomySingularName, $taxonomyPluralName),
            'admin_cols' => [
                'updated' => [
                    'title_cb'    => function () {
                        return '<em>Last</em> Updated';
                    },
                    'meta_key'    => 'updated_date',
                    'date_format' => 'd/m/Y',
                ],
            ],
        ];

        $names = [
            'plural' => $taxonomyPluralName,
        ];

        return register_extended_taxonomy(self::TAXONOMY, self::POST_TYPE, $args, $names);
    }
}
