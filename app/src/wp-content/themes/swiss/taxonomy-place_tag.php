<?php

get_header();

?>
  <?php $activeterm = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
  $is_custom = false;
  ?>
  <?php if( have_rows('customized_tag_headers_places', 'option') ): ?>
<?php while( have_rows('customized_tag_headers_places', 'option') ): the_row(); ?>

    <?php 
    $customtag = get_sub_field('tag_name');
    if($activeterm == $customtag) {
        $bg_color = get_sub_field('background_color'); 
        $bg_image = get_sub_field('background_image');
        $is_custom = true;
    }
 ?>

<?php endwhile; ?>
<?php endif; ?>
  <?php if( !$is_custom && have_rows('places_header', 'option') ): ?>
<?php while( have_rows('places_header', 'option') ): the_row(); ?>

    <?php $bg_color = get_sub_field('background_color'); 
    $bg_image = get_sub_field('background_image'); ?>

<?php endwhile; ?>
<?php endif; ?>
<section class="b-hero <?php if ($bg_image) : ?>b-hero--with-image<?php endif;?> <?php if ($bg_color) : ?>b-hero--<?php echo $bg_color ?><?php endif;?>">

<div class="b-hero__background" style="background-image:url(<?php echo  $bg_image ?>);"></div>

    <?php if($bg_image): ?>
        <div class="c-overlay"></div>
    <?php endif; ?>

<div class="b-hero__container">
    <div class="b-hero__content">
    <div class="h-wysiwyg-html">
        <h1><?php echo $activeterm->name; ?></h1></div>
    </div>
</div><!-- end of b-hero__container -->
</section><!-- end of b-hero -->
<div class="b-hero__koro"></div>

  <section class="b-listing">
  <h4 class="b-taglist__mobile-filter-title js-show-tags-mobile"><?php _e('Filter', 'swiss');?></h4>
    <div class="b-taglist__container">
    <a href="<?php the_field('place_archive','option');?>" class="b-taglist__tag c-btn">
    <?php _e('Favourites', 'swiss');?></a>
  <?php
        $terms = get_terms( array(
            'taxonomy' => 'place_tag'
        ) ); ?>
        <?php foreach ( $terms as $term ) : ?>
        <a class="b-taglist__tag c-btn <?php if ($term == $activeterm): ?>c-btn--active<?php endif;?>" href="<?php $link = get_term_link($term); echo esc_url($link); ?>"><?php echo $term->name; ?></a>
        <?php endforeach; ?>
      <?php 
          $args = array(
            'post_type' => 'place',
            'place_tag' => $activeterm->slug,
            'posts_per_page' => 99
        );
        $query = new WP_Query( $args );
      ?>
      </div>
    <div class="b-listing__container b-listing__container--taxonomy-page">
<div class="l-cards l-cards--four">
        <?php while  ($query->have_posts() ) : $query->the_post(); ?>
        <div class="l-cards__item">
        <div class="c-slideshow-card">

    <div class="c-slideshow-card__image" style="background-image:url(<?php echo \Evermade\Swiss\featuredImageUrl('medium-large'); ?>)"></div>
    <div class="c-overlay"></div>


    <div class="c-slideshow-card__text">
    <div class="h-wysiwyg-html"><h3><?php the_title(); ?></h3><p><?php echo get_field('description');?></p></div></div>

    <a href="<?php echo get_field('link'); ?>" class="c-slideshow-card__overlay-link"></a>

</div>
</div>
        <?php endwhile; ?>
      </div>
    </div><!-- #content -->
  </div><!-- #container -->

<?php

get_footer();
