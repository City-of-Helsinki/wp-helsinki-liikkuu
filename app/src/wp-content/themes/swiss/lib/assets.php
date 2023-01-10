<?php
namespace Evermade\Swiss\Assets;

function publicScriptsAndStyles()
{

    // scripts
    wp_enqueue_script('modernizr', '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js');

    wp_enqueue_script('swiss-js', get_template_directory_uri().'/assets/dist/js/bundle.'.filemtime(get_stylesheet_directory() . '/assets/dist/js/bundle.js').'.js', array('jquery'), null, true);

    // fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,100italic,100,300italic,500,500italic,700,700italic,900,900italic');
    wp_enqueue_style('font-awesome', 'https://use.fontawesome.com/releases/v5.0.6/css/all.css');

    // styles
    wp_enqueue_style('swiss-css', get_template_directory_uri().'/assets/dist/css/bundle.'.filemtime(get_stylesheet_directory() . '/assets/dist/css/bundle.css').'.css');

        // localization of swiss-js, accessible under global swissLocalization js object
        $translation_array = array(
            'show_more' => __('Show more', 'swiss'),
            'filter' => __('Filter', 'swiss'),
            'remove_filters' => __('Remove filters', 'swiss'),
            'read_more' => __('Read more', 'swiss')
        );
        wp_localize_script('swiss-js', 'swissLocalization', $translation_array);
}

add_action('wp_enqueue_scripts', 'Evermade\Swiss\Assets\publicScriptsAndStyles');

function admin_scripts_and_styles()
{
    wp_enqueue_script('swiss-acf', get_template_directory_uri().'/assets/admin/js/acf.'.filemtime(get_stylesheet_directory() . '/assets/admin/js/acf.js').'.js', array(), null, true);
}

add_action('admin_enqueue_scripts', 'Evermade\Swiss\Assets\admin_scripts_and_styles');
