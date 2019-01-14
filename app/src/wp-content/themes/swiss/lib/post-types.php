<?php
namespace Evermade\Swiss\PostTypes;

/*
 * -----------------------------------------------------
 * EXAMPLE POST TYPE
 * -----------------------------------------------------
 */

function ideaSetup()
{
    $labels = array(
        'name'                  => _x('Idea', 'post type general name', 'swiss'),
        'singular_name'         => _x('Idea', 'post type singular name', 'swiss'),
        'add_new'               => _x('Add New Idea', 'the add new post text', 'swiss'),
        'add_new_item'          => _x('Add New Idea', 'the add new post text', 'swiss'),
        'edit_item'             => _x('Edit Idea', 'the edit post text', 'swiss'),
        'new_item'              => _x('New Idea', 'add new post text', 'swiss'),
        'all_items'             => _x('Idea', 'String for the submenu', 'swiss'),
        'view_item'             => _x('View Idea', 'view post text', 'swiss'),
        'search_items'          => _x('Search Idea', 'search post text', 'swiss'),
        'not_found'             => _x('No Ideas found', 'not found post text', 'swiss'),
        'not_found_in_trash'    => _x('No Ideas found in the Trash', 'not found trash post text', 'swiss'),
        'parent_item_colon'     => '',
        'menu_name'             => _x('Ideas', 'post type general name for menu', 'swiss')
    );

    $args = array(
        'labels'                => $labels,
        'description'           => _x('This is an Idea description', 'post type description', 'swiss'),
        'public'                => true,
        'menu_position'         => 5,
        'supports'              => array( 'title', 'thumbnail' ),
        'taxonomies'            => array( '' ),
        'has_archive'           => true,
        'publicly_queryable'    => true,
        'exclude_from_search'   => true,
        'menu_icon'             => 'dashicons-lightbulb',
        'rewrite'               => array(
            'slug' => _x('idea', 'URL slug', 'swiss')
        )
    );

    register_post_type('Idea', $args);
}

function create_type_taxonomy() {
	$labels = array(
		'name'              => _x( 'Types', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Type', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Types', 'textdomain' ),
		'all_items'         => __( 'All Types', 'textdomain' ),
		'parent_item'       => __( 'Parent Type', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Type:', 'textdomain' ),
		'edit_item'         => __( 'Edit Type', 'textdomain' ),
		'update_item'       => __( 'Update Type', 'textdomain' ),
		'add_new_item'      => __( 'Add New Type', 'textdomain' ),
		'new_item_name'     => __( 'New Type Name', 'textdomain' ),
		'menu_name'         => __( 'Type', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
        'rewrite'           => array( 'slug' => 'type' ),
        'has_archive'       => true
	);

	register_taxonomy( 'type', array( 'idea' ), $args );
}

function placeSetup()
{
    $labels = array(
        'name'                  => _x('Place', 'post type general name', 'swiss'),
        'singular_name'         => _x('Place', 'post type singular name', 'swiss'),
        'add_new'               => _x('Add New Place', 'the add new post text', 'swiss'),
        'add_new_item'          => _x('Add New Place', 'the add new post text', 'swiss'),
        'edit_item'             => _x('Edit Place', 'the edit post text', 'swiss'),
        'new_item'              => _x('New Place', 'add new post text', 'swiss'),
        'all_items'             => _x('Place', 'String for the submenu', 'swiss'),
        'view_item'             => _x('View Place', 'view post text', 'swiss'),
        'search_items'          => _x('Search Place', 'search post text', 'swiss'),
        'not_found'             => _x('No Places found', 'not found post text', 'swiss'),
        'not_found_in_trash'    => _x('No Places found in the Trash', 'not found trash post text', 'swiss'),
        'parent_item_colon'     => '',
        'menu_name'             => _x('Places', 'post type general name for menu', 'swiss')
    );

    $args = array(
        'labels'                => $labels,
        'description'           => _x('This is an Place description', 'post type description', 'swiss'),
        'public'                => true,
        'menu_position'         => 5,
        'supports'              => array( 'title', 'thumbnail' ),
        'taxonomies'            => array( '' ),
        'has_archive'           => true,
        'publicly_queryable'    => false,
        'exclude_from_search'   => true,
        'menu_icon'             => 'dashicons-location',
        'rewrite'               => array(
            'slug' => _x('place', 'URL slug', 'swiss')
        )
    );

    register_post_type('Place', $args);
}

function create_place_tag_taxonomy() {
	$labels = array(
		'name'              => _x( 'Place tags', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Place tag', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Place tags', 'textdomain' ),
		'all_items'         => __( 'All Place tags', 'textdomain' ),
		'edit_item'         => __( 'Edit Place tag', 'textdomain' ),
		'update_item'       => __( 'Update Place tag', 'textdomain' ),
		'add_new_item'      => __( 'Add New Place tag', 'textdomain' ),
		'new_item_name'     => __( 'New Place tag Name', 'textdomain' ),
		'menu_name'         => __( 'Place tag', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
        'rewrite'           => array( 'slug' => 'place_tag' ),
        'has_archive'       => true
	);

	register_taxonomy( 'place_tag', array( 'place' ), $args );
}
/*
 * -----------------------------------------------------
 * ENABLE/DISABLE CUSTOM POST TYPES
 * -----------------------------------------------------
 */

function setCustomTypes()
{
    ideaSetup();
    placeSetup();

}

add_action('init', 'Evermade\Swiss\PostTypes\setCustomTypes');
add_action( 'init', 'Evermade\Swiss\PostTypes\create_type_taxonomy' );
add_action( 'init', 'Evermade\Swiss\PostTypes\create_place_tag_taxonomy' );
