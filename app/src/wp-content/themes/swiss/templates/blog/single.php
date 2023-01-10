<?php get_header(); ?>

<?php if (have_posts()) : global $post; while (have_posts()) : the_post(); $my_post = new \Evermade\Swiss\Post($post); ?>

<div class="s-context">
    <section class="b-blog">
        <div class="b-blog__container b-blog__container--wider">
            <div class="l-divided-spotlight" data-column-count="1">
                <div class="l-divided-spotlight__items">
                    <div class="l-divided-spotlight__item">
                        <?php include(get_template_directory().'/templates/blog/_c-blog-single-header.php'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="b-blog__container">
            <div class="l-blog">

                <div class="l-blog__content">

                    <?php include(get_template_directory().'/templates/blog/_c-blog-author.php'); ?>

                    <div class="h-wysiwyg-html">
                        <article class="c-article" data-scheme-target>
                            <?php the_content(); ?>
                        </article>
                    </div>

               </div>
            </div>
        </div>
        <div class="b-blog__sharebuttons">
                    <div class="c-blog-share">
                        <?php echo Evermade\Swiss\sharePage(); ?>
                    </div>

                    </div>
    </section>

    <?php endwhile; else: ?>

    <p><?php _e('Sorry, no posts matched your criteria.', 'swiss'); ?></p>

    <?php endif; ?>


    <section class="b-blog">
        <?php

        // amount of items pulled. Also sets the layout with data-column-count
        $amountOfPosts = 3;

        // Pulls posts according to the logic from lib/functions/blog.php
        $moreposts = \Evermade\Swiss\Blog\getPostsReadMore($amountOfPosts, $post->ID);

        ?>

        <div class="b-blog__container">
            <div class="h-wysiwyg-html">
                <h3><?php _e('Latest Articles', 'swiss');?></h3>
            </div>
        </div>

        <div class="b-blog__container b-blog__container--wider">
            <div class="l-cards" data-column-count="<?php echo $amountOfPosts; ?>">

                <?php foreach ($moreposts as $post) {
                    $my_post = new \Evermade\Swiss\Post($post); ?>

                    <div class="l-cards__item">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" data-animate="animated zoomIn" class="c-card">
                            <div class="c-card__imagewrapper">
                                <div class="c-card__image" style="background-image:url(<?php echo \Evermade\Swiss\featuredImageUrl('hero-extra-large'); ?>);">
                                    <div class="c-card__meta" aria-hidden="true">
                                        <?php  echo get_the_date(); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="c-card__content">
                                <h4 class="c-card__title">
                                    <div>
                                        <?php the_title(); ?>
                                    </div>
                                </h4>
                                <div class="c-card__readmore">
                                    <div class="c-cta-link">
                                        <?php _e('Read more', 'swiss'); ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                <?php } ?>

            </div>
        </div>
    </section>
</div>

<?php get_footer();
