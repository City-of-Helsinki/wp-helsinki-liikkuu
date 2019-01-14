<?php
// lets keep block data in class for encapsulation and stopping conflicts across blocks
$block = new \Evermade\Swiss\Block(array('section_header', 'posts', 'number_of_posts', 'see_more', 'see_more_text', 'see_more_url'));

if(empty($block->get('posts'))){

    $block->set('see_more_show', false);

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $block->get('number_of_posts', 'fields', 4)
    );

    $custom_query = new \WP_Query($args);

    $block->set('posts', $custom_query->posts, 'fields');

}

include(__DIR__.'/templates/view.php');
