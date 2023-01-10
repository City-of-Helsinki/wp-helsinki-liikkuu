<?php
/*
 * Template Name: Page with subpage navi
 */

global $app;
?>

<?php include(get_template_directory().'/templates/head.php'); ?>
<a href="#c" class="c-skip-to-content js-skip-to-content">
    <?php _e('Skip to content', 'swiss');?>
</a>

<?php include(get_template_directory().'/templates/_site-header.php'); ?>
<?php include(get_template_directory().'/templates/_navbar-subpages.php'); ?>

<div class="b-page-content" id="c" role="main">

    <div class="s-context">
        <div>
            <div>
                <?php \Evermade\Swiss\Acf\postBlocks(); ?>
            </div>
        </div>
    </div>

</div><!-- end of .page-content -->

<footer class="b-footer">
<div class="b-navbar__container">
    <div class="b-footer__navcontainer b-footer__navcontainer--subpages">
        <nav class="c-primary-navigation" aria-label="<?php _e('Footer navigation', 'swiss');?>">
            <?php if ( 0 == $post->post_parent ) {?>
                <a href="<?php the_permalink();?>"><?php the_title();?></a>
            <?php } else {
                $parents = get_ancestors( $post->ID, 'page', 'post_type' );
                foreach( $parents as $parent ) {?>
                    <a href="<?php the_permalink($parent)?>"><?php echo get_the_title( $parent );?></a>
                <?php }
            } ?>
        </nav>

        <nav class="c-secondary-navigation">
            <?php
            if ( is_page() && $post->post_parent )
                $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
            else
                $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
            if ( $childpages ) {
                $childpages = str_replace('page_item', 'c-primary-navigation__item', $childpages);
                $home_url = apply_filters( 'wpml_home_url', get_option( 'home' ) );
                $childpages .= '<li class="c-primary-navigation__item"><a href="'.$home_url.'">'.get_the_title(get_option('page_on_front')).'</a></li>';
                $navi = '<ul class="c-secondary-navigation__items">' . $childpages . '</ul>';
            }
            echo $navi;
            ?>
        </nav>
    </div>
    </div>

    <div class="b-footer__lower">
        <?php if( have_rows('footer_links', 'option') ): ?>
        <div class="b-footer__links">
        <?php while( have_rows('footer_links', 'option') ): the_row(); ?>

        <a href="<?php the_sub_field('link_url'); ?>"><?php the_sub_field('link_text'); ?></a>

        <?php endwhile; ?>
        </div>
        <?php endif; ?>
        <div class="b-footer__logos">
        <div class="b-footer__logos-item">
        <img class="b-footer__logos-item--helsinki" alt="<?php _e('Helsinki', 'swiss');?>" src="
                <?php 
                global $sitepress;
                $logo = $sitepress->get_current_language() == 'sv' ? 'helsingfors_logo.svg' : 'helsinki-logo2.svg';
                echo get_template_directory_uri() . '/assets/img/' . $logo; 
                ?>" 
                alt="<?php bloginfo('name'); ?>">
        </div>

        <div class="b-footer__logos-item">
            <?php echo \Evermade\Swiss\template('_social-media.php', $app->get('opt_social_media')); ?>
        </div>
        </div>
        <div class="b-footer__copyright">
            <p>&copy; <?php _e('Copyright', 'swiss');?> <?php echo date('Y');?>&nbsp;•&nbsp;<?php bloginfo('name'); ?>&nbsp;•&nbsp;<?php _e('All rights reserved', 'swiss');?>.</p>
            <p><?php _e('Website crafted by', 'swiss');?> <a href="https://www.evermade.fi" rel="noopener noreferrer">Evermade</a>.</p>
        </div>
    </div>


</footer><!-- end of footer -->

<?php include(get_template_directory().'/templates/modals.php'); ?>

<?php include(get_template_directory().'/templates/foot.php'); ?>