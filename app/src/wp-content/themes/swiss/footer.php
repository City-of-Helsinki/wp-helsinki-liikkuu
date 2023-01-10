<?php
    global $app;
?>
</div><!-- end of .page-content -->

<footer class="b-footer">

    <div class="b-footer__navcontainer">
        <nav class="b-footer__navigation" aria-label="<?php _e('Footer navigation', 'swiss');?>">
            <?php wp_nav_menu(array(
                'theme_location' => 'footer-navigation',
                'menu_class' => 'c-page-navigation-footer',
                'container' => '',
                'fallback_cb' => false,
                'depth' => 1
            )); ?>
        </nav>
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