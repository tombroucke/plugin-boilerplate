<?php

namespace Otomaties\PluginBoilerplate\PostTypes;

use ExtCPTs\PostType as ExtCPTsPostType;
use Otomaties\PluginBoilerplate\Helpers\Labels;
use Otomaties\PluginBoilerplate\PostTypes\Contracts\PostType;
use Otomaties\PluginBoilerplate\Exceptions\ExtendedCptsNotInstalledException;

class BookExample implements PostType
{
    const POST_TYPE = 'book';

    public function register() : ExtCPTsPostType
    {
        if (!function_exists('register_extended_post_type')) {
            throw new ExtendedCptsNotInstalledException();
        }

        $postSingularName = __('Book', 'plugin-boilerplate');
        $postPluralName = __('Books', 'plugin-boilerplate');

        $args = [
            'show_in_feed' => true,
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-book',
            'labels' => Labels::postType($postSingularName, $postPluralName),
            'dashboard_activity' => true,
            'admin_cols' => [
                'book_featured_image' => [
                        'title'          => __('Illustration', 'plugin-boilerplate'),
                    'featured_image' => 'thumbnail',
                ],
                'book_published' => [
                    'title_icon'  => 'dashicons-calendar-alt',
                    'meta_key'    => 'published_date',
                    'date_format' => 'd/m/Y',
                ],
            ],
            'admin_filters' => [
                'book_rating' => [
                    'meta_key' => 'star_rating',
                ],
            ],

        ];

        $names = [
            'singular' => $postSingularName,
            'plural'   => $postPluralName,
            'slug'     => self::POST_TYPE,
        ];

        return register_extended_post_type(self::POST_TYPE, $args, $names);
    }
}
