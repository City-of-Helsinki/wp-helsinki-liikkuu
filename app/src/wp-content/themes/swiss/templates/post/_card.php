<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" data-animate="animated zoomIn" class="c-card <?php if($isEvent) : ?>c-card--event<?php else: ?>c-card--default<?php endif; ?> trigger-hover">
    <div class="c-card__imagewrapper"><div class="c-card__image" style="background-image:url(
            <?php  echo \Evermade\Swiss\featuredImageUrl('medium-large'); ?>);">
                    <div class="c-card__meta" aria-hidden="true">
                    <?php echo get_the_date(); ?>
                    </div>
                    </div>
        </div>
        <div class="c-card__content">
         <h4 class="c-card__title"><div><?php the_title(); ?></div></h4>
    <div class="c-card__readmore"><div class="c-cta-link"><?php _e('Read more', 'swiss'); ?></div></div></div>
 </a>