<section class="b-navbar js-navbar js-sticky" role="navigation">
    <div class="b-navbar__container">
    <a class="b-navbar__logo" href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"></a>


        <div class="b-navbar__navigation">

            <nav class="c-primary-navigation">
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
                    ob_start();
                    do_action('wpml_language_switcher', array('flags' => true, 'translated' => false));
                    $wpmlnavi = ob_get_clean();
                    $navi = '<ul class="c-secondary-navigation__items">' . $childpages . $wpmlnavi . '</ul>';
                }
                echo $navi;
                ?>
            </nav>

        </div>
        <div aria-label="Open mobile menu" role="button" aria-pressed="false" class="c-mobile-toggle" tabindex="0">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <div class="b-navbar__mobile-wrapper js-navbar-mobile-wrapper">
        <div class="b-navbar__mobile-wrapper__container">

            <div class="b-navbar__mobile-wrapper__content">
                <nav class="c-primary-navigation">
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
                        $navi = '<ul class="c-secondary-navigation__items">' . $childpages . '</ul>';
                    }
                    echo $navi;
                    ?>
                </nav>
            </div>

            <div class="b-navbar__mobile-wrapper__footer">
                <?php echo \Evermade\Swiss\wpmlLanguageSwitcher(); ?>
                <?php echo \Evermade\Swiss\template('_social-media.php', $app->get('opt_social_media')); ?>
                <img src="
                <?php 
                global $sitepress;
                $logo = $sitepress->get_current_language() == 'sv' ? 'helsingfors_logo.svg' : 'helsinki-logo2.svg';
                echo get_template_directory_uri() . '/assets/img/' . $logo; 
                ?>" 
                alt="<?php bloginfo('name'); ?>">
            </div>

        </div>
    </div>
</section>
