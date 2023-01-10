<?php namespace Evermade\Swiss\Hooks;

function removeWpLogo($wp_admin_bar)
{
    $wp_admin_bar->remove_node('updates');
    $wp_admin_bar->remove_node('comments');
    $wp_admin_bar->remove_node('wpseo-menu');
}

function hideWpUpdateNag()
{
    remove_action('admin_notices', 'update_nag', 3); // update notice at the top of the screen
    remove_filter('update_footer', 'core_update_footer'); // update notice in the footer
}

function registerMenus()
{
    register_nav_menus(
        array(
            'header-navigation' => __('Header Navigation'),
            'footer-navigation' => __('Footer Navigation'),
            'secondary-header-navigation' => __('Secondary Header Navigation')
        )
    );
}

function hideEditor()
{
    $template_file = basename(get_page_template());
    if ($template_file == 'page.php' || $template_file == 'template-page-subpages.php') {
        remove_post_type_support('page', 'editor');
    }
}

function customMCEbuttons()
{
    // Check if user have permission
    if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
        return;
    }
    // Check if WYSIWYG is enabled then add filters
    if ('true' == get_user_option('rich_editing')) {
        add_filter('mce_external_plugins', '\Evermade\Swiss\Hooks\custom_tinymce_plugin');
        add_filter('mce_buttons', '\Evermade\Swiss\Hooks\register_mce_button');
    }
}

// load our js
function custom_tinymce_plugin($plugin_array)
{
    $plugin_array['custom_mce_em_buttons'] = get_template_directory_uri() .'/assets/admin/js/editor_plugin.js';
    return $plugin_array;
}

function register_mce_button($buttons)
{
    array_push($buttons, 'custom_mce_em_button');
    if (\Evermade\Swiss\isDev()) {
        array_push($buttons, 'custom_mce_em_lorem');
    }
    return $buttons;
}

function loadTextDomain()
{
    load_theme_textdomain('swiss', get_template_directory() . '/languages');
}

function lowerWpseoPriority($html)
{
    return 'low';
}

// our filters that use the function above

// lets hide the admin bar in the
add_filter('show_admin_bar', '__return_false');

// lets add feature image to posts by default
add_theme_support('post-thumbnails');

add_theme_support('title-tag');

// register new buttons in the editor
add_action('admin_head', '\Evermade\Swiss\Hooks\customMCEbuttons');

// lets remove the main text editor from the post type as we are using block system
add_action('admin_head', '\Evermade\Swiss\Hooks\hideEditor');

// lets add our local languages for the swiss text domain
add_action('after_setup_theme', '\Evermade\Swiss\Hooks\loadTextDomain');

// navigation
add_action('init', '\Evermade\Swiss\Hooks\registerMenus');

// hide update nags
add_action('admin_menu', '\Evermade\Swiss\Hooks\hideWpUpdateNag');

// remove wp top bar stuff
add_action('admin_bar_menu', '\Evermade\Swiss\Hooks\removeWpLogo', 999);

// Lower the display priority of Yoast SEO meta box
add_filter('wpseo_metabox_prio', '\Evermade\Swiss\Hooks\lowerWpseoPriority');

// Add default page blocks feature
add_filter('acf/load_value/key=field_swiss_page_blocks_v1', '\Evermade\Swiss\Acf\defaultBlocks', 10, 3);

// when ACF inits lets add our local block field groups
add_action('acf/init', '\Evermade\Swiss\Acf\registerLocalBlockFieldGroups');

/**
 * Modifying tinymce text styles
 */

function customTextStyles($formats)
{
    $formats['style_formats'] = json_encode([
        [
            'title' => 'Paragraph',
            'block' => 'p'
        ],
        [
            'title' => 'Header 1',
            'block' => 'h1'
        ],
        [
            'title' => 'Header 2',
            'block' => 'h2'
        ],
        [
            'title' => 'Header 3',
            'block' => 'h3'
        ],
        [
            'title' => 'Header 4',
            'block' => 'h4'
        ],
        [
            'title' => 'Header 5',
            'block' => 'h5'
        ],
        [
            'title' => 'Header 6',
            'block' => 'h6'
        ],
        [
            'title' => 'Preformatted',
            'block' => 'pre'
        ],
        [
          'title' => 'Ingress',
          'block' => 'div',
          'classes' => 'h3'
        ]
  ]);

    return $formats;
}

add_filter('tiny_mce_before_init', '\Evermade\Swiss\Hooks\customTextStyles');

add_filter('mce_buttons', function ($buttons) {
  unset($buttons[array_search('formatselect', $buttons)]);
  array_unshift($buttons, "styleselect");

  return $buttons;
});

function tinymce_admin_styles() {
  echo '<style>
    .mce-menu-item.mce-menu-item-preview.mce-active .mce-text, .mce-menu-item.mce-menu-item-preview.mce-active .mce-ico {color: inherit !important;}
    .mce-menu-item.mce-menu-item-preview.mce-active:hover span {color: #555c66 !important;}
  </style>';
}
add_action( 'admin_head', '\Evermade\Swiss\Hooks\tinymce_admin_styles' );

add_filter('tiny_mce_before_init','\Evermade\Swiss\Hooks\tinyMCE_editor_dynamic_styles');
function tinyMCE_editor_dynamic_styles( $mceInit ) {
    $styles = 'body#tinymce.wp-editor div.h3 {display: block;font-size: 1.17em;margin-block-start: 1em;margin-block-end: 1em;margin-inline-start: 0px;margin-inline-end: 0px;font-weight: bold;}';
    if ( isset( $mceInit['content_style'] ) ) {
        $mceInit['content_style'] .= ' ' . $styles . ' ';
    } else {
        $mceInit['content_style'] = $styles . ' ';
    }
    return $mceInit;
}

function switch_page_template() {
    global $post;
    // Checks if current post type is a page, rather than a post
	if (is_page())
	{	
		// Checks if page is parent, if yes, return
		if ($post->post_parent == 0)
			return true;
		else if ($post->post_parent != $post->ID)
		{
			$parent_page_template = get_post_meta($post->post_parent,'_wp_page_template',true);
 
			$template = TEMPLATEPATH . "/{$parent_page_template}";
			if (file_exists($template)) {
				load_template($template);
				exit;
			}
		}
	}
}
 
add_action('template_redirect','\Evermade\Swiss\Hooks\switch_page_template');