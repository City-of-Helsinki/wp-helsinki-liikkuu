<?php

// https://www.advancedcustomfields.com/resources/register-fields-via-php/

return array (
    'key' => 'group_'.$blockName,
    'name' => $blockName,
    'label' => str_replace('-', ' ', ucfirst($blockName)),
    'display' => 'block',
    'sub_fields' => array(
        array(
            'key' => 'field_'.$blockName.'_feed',
            'label' => 'Feed',
            'name' => 'feed',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'tabs' => 'all',
            'toolbar' => 'full',
            'media_upload' => 1,
            'delay' => 0,
        ),
        array(
            'key' => 'field_'.$blockName.'_how_many_posts',
            'label' => 'How Many Posts',
            'name' => 'how_many_posts',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '8',
            'tabs' => 'all',
            'toolbar' => 'full',
            'media_upload' => 1,
            'delay' => 0,
        ),
    ),
    'min' => '',
    'max' => '',
);
