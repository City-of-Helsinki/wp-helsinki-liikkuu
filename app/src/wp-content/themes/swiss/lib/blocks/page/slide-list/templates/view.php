<section class="b-slide-list">
    <div class="b-container">
    <?php include get_template_directory().'/templates/_section-header.php'; ?>
    </div>
    <div class="b-slide-list__container">   
        <div class="b-slide-list__slides">
            <h3 class="b-slide-list__title"><?php echo $block->get('title'); ?></h3>
            <?php if(!empty($block->get('slides'))): ?>
            <div class="l-cards-slideshow js-card-slideshow">

            <?php global $post; foreach($block->get('slides') as $k => $post): setup_postdata($post); ?>
                    <div class="l-cards-slideshow__item">

                        <div class="c-slideshow-card <?php if ( ! empty( $slide['link'] ) ): ?> c-slideshow-card--hover-effect<?php endif; ?>">

                            <div class="c-slideshow-card__image" style="background-image:url(<?php echo \Evermade\Swiss\featuredImageUrl('medium-large'); ?>)"></div>
                            <div class="c-overlay"></div>

                            <div class="c-slideshow-card__text <?php if (get_field('description')) : ?>c-slideshow-card__text--with-desc<?php endif;?>">
                            <h3><?php the_title(); ?></h3>
                            <?php if (get_field('description')) : ?>
                            <p class="c-slideshow-card__description"><?php echo get_field('description'); ?></p>
                            <?php endif; ?>

                            </div>

                         <a href="<?php echo get_field('link'); ?>" aria-label="<?php echo get_the_title() . ' ' . parse_url(get_field('link'))['host']; ?>" class="c-slideshow-card__overlay-link"></a>


                        </div>
                    </div>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>
                <?php endif; ?>
</div>
        </div>
    <?php if($block->get('see_more')): ?>
            <div class="b-listing__see-more">
                <a href="<?php echo $block->get('see_more_url'); ?>" class="c-btn" aria-label="<?php echo $block->get('see_more_text') . ' ' . $block->get('see_more_url'); ?>"><?php echo $block->get('see_more_text'); ?></a>
            </div>
    <?php endif; ?>
</section>
