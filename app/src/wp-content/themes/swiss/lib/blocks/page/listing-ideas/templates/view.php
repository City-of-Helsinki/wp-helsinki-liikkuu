<section class="b-listing">

    <div class="b-listing__container">

        <?php include get_template_directory().'/templates/_section-header.php'; ?>

        <?php if(!empty($block->get('posts'))): ?>
        <?php $numberofposts = sizeof($block->get('posts')); ?>
            <div class="l-grid l-grid--<?php echo $numberofposts; ?>">

            <?php global $post; foreach($block->get('posts') as $k => $post): setup_postdata($post); ?>

                <div class="l-grid__item">
                <a href="<?php the_permalink();?>">
                    <div class="c-idea-card">
                    <div style="background-image:url(<?php echo \Evermade\Swiss\featuredImageUrl('medium-large'); ?>)" class="c-idea-card__bg"><div class="c-overlay"></div>
                </div>
                <h2 class="c-idea-card__title"><?php the_title();?></h2>
                    </div>
                    </a>
                </div>

            <?php endforeach; wp_reset_postdata(); ?>

            </div>

        <?php endif; ?>

        <?php if($block->get('see_more')): ?>
            <div class="b-listing__see-more">
                <a href="<?php echo $block->get('see_more_url'); ?>" class="c-btn" aria-label="<?php echo $block->get('see_more_text') . ' ' . $block->get('see_more_url'); ?>"><?php echo $block->get('see_more_text'); ?></a>
            </div>
        <?php endif; ?>

    </div><!-- end of b-listing__container -->
</section><!-- end of b-listing -->
