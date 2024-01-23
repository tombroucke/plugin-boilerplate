<?php

namespace Otomaties\PluginBoilerplate\Models\Abstracts;

abstract class Post
{
    private \WP_Post $post;

    public function __construct(\WP_Post|int $post
    )
    {
        if (is_int($post)) {
            $post = get_post($post);
        }

        $this->post = $post;
    }

    public function getId()
    {
        return $this->post->ID;
    }

    public function title()
    {
        return $this->post->post_title;
    }

    public function content()
    {
        return $this->post->post_content;
    }

    public function url()
    {
        return get_permalink($this->post);
    }

    public function thumbnail($size = 'thumbnail', $attr = []) : string
    {
        return get_the_post_thumbnail($this->post, $size, $attr);
    }

    public function thumbnailUrl($size = 'thumbnail') : ?string
    {
        $url = get_the_post_thumbnail_url($this->post, $size);
        return $url != '' ? $url : null;
    }

    public function attachedMedia()
    {
        return get_attached_media('image', $this->post);
    }

    public function getMeta($key, $single = true)
    {
        return get_post_meta($this->getId(), $key, $single);
    }

    public function setParent(int $parentId) 
    {
        wp_update_post([
            'ID' => $this->getId(),
            'post_parent' => $parentId
        ]);
    }
}
