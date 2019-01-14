<?php

// create a new block object to work with
$block = new \Evermade\Swiss\Block(['section_header', 'slides', 'see_more', 'see_more_text','see_more_url', 'title']);

if(empty($block->get('slides'))){

    $block->set('see_more_show', false);

    $args = array(
        'post_type' => 'place',
        'posts_per_page' => $block->get('number_of_posts', 'fields', 6)
    );

    $custom_query = new \WP_Query($args);

    $block->set('slides', $custom_query->posts, 'fields');

}

if ( ! empty( $block->get('slides') ) )
    include (__DIR__.'/templates/view.php');
