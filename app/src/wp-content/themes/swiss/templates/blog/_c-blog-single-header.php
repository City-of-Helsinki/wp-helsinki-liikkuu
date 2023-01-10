<div class="c-blog-single-header">

    <div class="c-blog-single-header__back">
        <a href="/blog/">View all Posts</a>
    </div>

    <div class="c-blog-single-header__image">

        <div class="c-background-image" style="background-image:url(<?php echo get_the_post_thumbnail_url(get_the_ID(),'hero-large'); ?>);"></div>
        <div class="c-overlay"></div>

    </div>

    <div class="c-blog-single-header__text">

        <p class="c-blog-single-header__date"><?php the_date(); ?></p>

        <h1>
            <?php the_title(); ?>
        </h1>

    </div>

</div><!-- end of c-post-small component -->
