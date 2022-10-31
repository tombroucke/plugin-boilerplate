<?php //phpcs:ignore
namespace Otomaties\PluginBoilerplate;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Create custom post types and taxonomies
 */
class CustomPostTypes
{

    /**
     * Register post type story
     */
    public function addStories() : void
    {
        $postType = 'story';
        $slug = 'stories';
        $postSingularName = __('Story', 'plugin-boilerplate');
        $postPluralName = __('Stories', 'plugin-boilerplate');

        register_extended_post_type(
            $postType,
            [
                'show_in_feed' => true,
                'show_in_rest' => true,
                'labels' => $this->postTypeLabels($postSingularName, $postPluralName),
                'dashboard_activity' => true,
                'admin_cols' => [
                    'story_featured_image' => [
                         'title'          => __('Illustration', 'plugin-boilerplate'),
                        'featured_image' => 'thumbnail',
                    ],
                    'story_published' => [
                        'title_icon'  => 'dashicons-calendar-alt',
                        'meta_key'    => 'published_date',
                        'date_format' => 'd/m/Y',
                    ],
                    'story_genre' => [
                        'taxonomy' => 'genre',
                    ],
                ],
                'admin_filters' => [
                    'story_genre' => [
                        'taxonomy' => 'genre',
                    ],
                    'story_rating' => [
                        'meta_key' => 'star_rating',
                    ],
                ],

            ],
            [
                'singular' => $postSingularName,
                'plural'   => $postPluralName,
                'slug'     => $slug,
            ]
        );

        $taxSlug = 'genre';
        $taxonomySingularName = __('Genre', 'plugin-boilerplate');
        $taxonomyPluralName = __('Genres', 'plugin-boilerplate');

        register_extended_taxonomy(
            $taxSlug,
            $postType,
            [
                'meta_box' => 'radio', // can be null, 'simple', 'radio', 'dropdown'
                'exclusive' => false, // true means: just one can be selected; only for simple
                'labels' => $this->taxonomyLabels($taxonomySingularName, $taxonomyPluralName),
                'admin_cols' => [
                    'updated' => [
                        'title_cb'    => function () {
                            return '<em>Last</em> Updated';
                        },
                        'meta_key'    => 'updated_date',
                        'date_format' => 'd/m/Y',
                    ],
                ],
            ],
            [
                'plural' => $taxonomyPluralName,
            ]
        );
    }

    public function addStoryFields() : void
    {
        $story = new FieldsBuilder('story');
        $story
            ->addText('author', [
                'label' => __('Author', 'sage'),
            ])
            ->setLocation('post_type', '==', 'story');
        acf_add_local_field_group($story->build());
    }

    /**
     * Translate post type labels
     *
     * @param  string $singular_name The singular name for the post type.
     * @param  string $plural_name   The plural name for the post type.
     * @return array<string, string>
     */
    private function postTypeLabels(string $singular_name, string $plural_name) : array
    {
        return [
            'add_new' => __('Add New', 'plugin-boilerplate'),
            /* translators: %s: singular post name */
            'add_new_item' => sprintf(
                __('Add New %s', 'plugin-boilerplate'),
                $singular_name
            ),
            /* translators: %s: singular post name */
            'edit_item' => sprintf(
                __('Edit %s', 'plugin-boilerplate'),
                $singular_name
            ),
            /* translators: %s: singular post name */
            'new_item' => sprintf(
                __('New %s', 'plugin-boilerplate'),
                $singular_name
            ),
            /* translators: %s: singular post name */
            'view_item' => sprintf(
                __('View %s', 'plugin-boilerplate'),
                $singular_name
            ),
            /* translators: %s: plural post name */
            'view_items' => sprintf(
                __('View %s', 'plugin-boilerplate'),
                $plural_name
            ),
            /* translators: %s: singular post name */
            'search_items' => sprintf(
                __('Search %s', 'plugin-boilerplate'),
                $plural_name
            ),
            /* translators: %s: plural post name to lower */
            'not_found' => sprintf(
                __('No %s found.', 'plugin-boilerplate'),
                strtolower($plural_name)
            ),
            /* translators: %s: plural post name to lower */
            'not_found_in_trash' => sprintf(
                __('No %s found in trash.', 'plugin-boilerplate'),
                strtolower($plural_name)
            ),
            /* translators: %s: singular post name */
            'parent_item_colon' => sprintf(
                __('Parent %s:', 'plugin-boilerplate'),
                $singular_name
            ),
            /* translators: %s: singular post name */
            'all_items' => sprintf(
                __('All %s', 'plugin-boilerplate'),
                $plural_name
            ),
            /* translators: %s: singular post name */
            'archives' => sprintf(
                __('%s Archives', 'plugin-boilerplate'),
                $singular_name
            ),
            /* translators: %s: singular post name */
            'attributes' => sprintf(
                __('%s Attributes', 'plugin-boilerplate'),
                $singular_name
            ),
            /* translators: %s: singular post name to lower */
            'insert_into_item' => sprintf(
                __('Insert into %s', 'plugin-boilerplate'),
                strtolower($singular_name)
            ),
            /* translators: %s: singular post name to lower */
            'uploaded_to_this_item'    => sprintf(
                __('Uploaded to this %s', 'plugin-boilerplate'),
                strtolower($singular_name)
            ),
            /* translators: %s: plural post name to lower */
            'filter_items_list' => sprintf(
                __('Filter %s list', 'plugin-boilerplate'),
                strtolower($plural_name)
            ),
            /* translators: %s: singular post name */
            'items_list_navigation' => sprintf(
                __('%s list navigation', 'plugin-boilerplate'),
                $plural_name
            ),
            /* translators: %s: singular post name */
            'items_list' => sprintf(
                __('%s list', 'plugin-boilerplate'),
                $plural_name
            ),
            /* translators: %s: singular post name */
            'item_published' => sprintf(
                __('%s published.', 'plugin-boilerplate'),
                $singular_name
            ),
            /* translators: %s: singular post name */
            'item_published_privately' => sprintf(
                __('%s published privately.', 'plugin-boilerplate'),
                $singular_name
            ),
            /* translators: %s: singular post name */
            'item_reverted_to_draft' => sprintf(
                __('%s reverted to draft.', 'plugin-boilerplate'),
                $singular_name
            ),
            /* translators: %s: singular post name */
            'item_scheduled' => sprintf(
                __('%s scheduled.', 'plugin-boilerplate'),
                $singular_name
            ),
            /* translators: %s: singular post name */
            'item_updated' => sprintf(
                __('%s updated.', 'plugin-boilerplate'),
                $singular_name
            ),
        ];
    }

    /**
     * Translate taxonomy labels
     *
     * @param  string $singular_name The singular name for the taxonomy.
     * @param  string $plural_name   The plural name for the taxonomy.
     * @return array<string, string>
     */
    private function taxonomyLabels($singular_name, $plural_name)
    {
        return [
            /* translators: %s: plural taxonomy name */
            'search_items' => sprintf(
                __('Search %s', 'plugin-boilerplate'),
                $plural_name
            ),
            /* translators: %s: plural taxonomy name */
            'popular_items' => sprintf(
                __('Popular %s', 'plugin-boilerplate'),
                $plural_name
            ),
            /* translators: %s: plural taxonomy name */
            'all_items' => sprintf(
                __('All %s', 'plugin-boilerplate'),
                $plural_name
            ),
            /* translators: %s: singular taxonomy name */
            'parent_item' => sprintf(
                __('Parent %s', 'plugin-boilerplate'),
                $singular_name
            ),
            /* translators: %s: singular taxonomy name */
            'parent_item_colon' => sprintf(
                __('Parent %s:', 'plugin-boilerplate'),
                $singular_name
            ),
            /* translators: %s: singular taxonomy name */
            'edit_item' => sprintf(
                __('Edit %s', 'plugin-boilerplate'),
                $singular_name
            ),
            /* translators: %s: singular taxonomy name */
            'view_item' => sprintf(
                __('View %s', 'plugin-boilerplate'),
                $singular_name
            ),
            /* translators: %s: singular taxonomy name */
            'update_item' => sprintf(
                __('Update %s', 'plugin-boilerplate'),
                $singular_name
            ),
            /* translators: %s: singular taxonomy name */
            'add_new_item' => sprintf(
                __('Add New %s', 'plugin-boilerplate'),
                $singular_name
            ),
            /* translators: %s: singular taxonomy name */
            'new_item_name' => sprintf(
                __('New %s Name', 'plugin-boilerplate'),
                $singular_name
            ),
            /* translators: %s: plural taxonomy name to lower */
            'separate_items_with_commas' => sprintf(
                __('Separate %s with commas', 'plugin-boilerplate'),
                strtolower($plural_name)
            ),
            /* translators: %s: plural taxonomy name to lower */
            'add_or_remove_items' => sprintf(
                __('Add or remove %s', 'plugin-boilerplate'),
                strtolower($plural_name)
            ),
            /* translators: %s: plural taxonomy name to lower */
            'choose_from_most_used' => sprintf(
                __('Choose from most used %s', 'plugin-boilerplate'),
                strtolower($plural_name)
            ),
            /* translators: %s: plural taxonomy name to lower */
            'not_found' => sprintf(
                __('No %s found', 'plugin-boilerplate'),
                strtolower($plural_name)
            ),
            /* translators: %s: plural taxonomy name to lower */
            'no_terms' => sprintf(
                __('No %s', 'plugin-boilerplate'),
                strtolower($plural_name)
            ),
            /* translators: %s: plural taxonomy name */
            'items_list_navigation' => sprintf(
                __('%s list navigation', 'plugin-boilerplate'),
                $plural_name
            ),
            /* translators: %s: plural taxonomy name */
            'items_list' => sprintf(
                __('%s list', 'plugin-boilerplate'),
                $plural_name
            ),
            'most_used' => 'Most Used',
            /* translators: %s: plural taxonomy name */
            'back_to_items' => sprintf(
                __('&larr; Back to %s', 'plugin-boilerplate'),
                $plural_name
            ),
            /* translators: %s: singular taxonomy name to lower */
            'no_item' => sprintf(
                __('No %s', 'plugin-boilerplate'),
                strtolower($singular_name)
            ),
            /* translators: %s: singular taxonomy name to lower */
            'filter_by' => sprintf(
                __('Filter by %s', 'plugin-boilerplate'),
                strtolower($singular_name)
            ),
        ];
    }
}
