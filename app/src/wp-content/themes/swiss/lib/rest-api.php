<?php
namespace Evermade\Swiss\RestApi;

function myAwesomePosts()
{

    $json = array();

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
    );

    $query = new \WP_Query($args);

    global $post;

    if (!empty($query->posts)) {
        foreach ($query->posts as $post) {
            $featured_img_url = get_the_post_thumbnail_url($post->ID,'post-thumbnail');
            $featured_img_url_medium = get_the_post_thumbnail_url($post->ID,'medium');
            $permalink = get_permalink($post->ID);
            $tags = wp_get_post_tags($post->ID);
            $date = get_the_date('j.n.Y',$post->ID);

            $post->post_date = $date;
            $post->post_image = $featured_img_url;
            $post->post_image_medium = $featured_img_url_medium;
            $post->post_permalink = $permalink;

            if($featured_img_url) {
                $post->post_image = $featured_img_url;
            }
            else {
                $post->post_image = get_template_directory_uri() . '/assets/img/oodi-default-img.png';
            }

            if($tags){
                $post->post_tags = $tags;
            }
            if(get_field('location',$post->ID)) {
                $event_location = get_field('location',$post->ID);
                $post->event_location = $event_location;
            }

            array_push($json, $post);
        }
    }

    return $json;
}

 add_action('rest_api_init', function()
 {
        register_rest_route('swiss/v1', '/posts', array(
        'methods' => 'GET',
        'callback' => '\Evermade\Swiss\RestApi\myAwesomePosts'
     ));

 });
