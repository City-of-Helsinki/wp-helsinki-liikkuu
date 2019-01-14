<div data-animate="animated zoomIn" class="c-card <?php if($isEvent) : ?>c-card--event<?php else: ?>c-card--default<?php endif; ?> trigger-hover">
    <a class="c-card__imagewrapper" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><div class="c-card__image" style="background-image:url(
            <?php  echo \Evermade\Swiss\featuredImageUrl('medium-large'); ?>);">
                    <div class="c-card__meta">
                    <?php echo get_the_date(); ?>
                    </div>
                    </div>
        </a>
        <div class="c-card__content">
         <h4 class="c-card__title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
    <div class="c-card__readmore"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="c-cta-link"><?php _e('Read more', 'swiss'); ?></a></div></div>
 </div>