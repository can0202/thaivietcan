<?php

/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    <div class="entry-meta entry-category">
      <span class="cat-links"><?php the_category(', '); ?></span>
    </div>
    <h1 class="entry-title"><?php the_title(); ?></h1>
  </header><!-- .entry-header -->
  <?php if (has_post_thumbnail()) : ?>
    <figure class="entry-thumbnail">
      <?php echo the_post_thumbnail(); ?>
    </figure>
  <?php endif; ?>

  <div class="entry-content">
    <?php
    the_content();
    wp_link_pages(array(
      'before' => '<div class="page-links">' . esc_html__('Pages:', 'type'),
      'after'  => '</div>',
    ));
    ?>
  </div><!-- .entry-content -->

</article><!-- #post-## -->