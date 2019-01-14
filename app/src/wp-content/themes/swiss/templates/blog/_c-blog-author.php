<?php if (is_single()) {
    ?>

    <div class="c-blog-author">
        <div class="c-blog-author__avatar" style="background-image:url(<?php $image=get_field('blog_author_image'); echo $image['sizes'][ 'thumbnail' ]; 
        ?>)">
        </div>
        <div class="c-blog-author__text" data-scheme-target>
        <b><?php echo get_field('blog_author_name'); ?></b><br>
        <?php echo get_field('blog_author_description'); ?>
        </div>

    </div>

<?php
} ?>