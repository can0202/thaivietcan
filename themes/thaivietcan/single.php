<?php get_header() ?>
<?php if (have_posts()) : ?>
  <div class="container content-area">
    <main id="main" class="site-main content" role="main">

      <?php
      while (have_posts()) : the_post();

        get_template_part('template_parts/post/content', 'single');

      ?>
        <!-- Panigation -->
        <div class="panigations d-flex align-items-center justify-between">
          <div class="panigation panigation__left">
            <?php next_post_link('%link', '<svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6.60156 9.7998L11.0016 5.3998L6.60156 0.999805" stroke="#3D3D3D" />
        <path d="M11 5.40039L0 5.40039" stroke="#3D3D3D" />
      </svg>' . __('<span>Prev</span>', 'indochine_house')); ?>

          </div>
          <div class="panigation panigation__right">
            <?php previous_post_link('%link', __('<span>Next</span>', 'indochine_house') . ' <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6.60156 9.7998L11.0016 5.3998L6.60156 0.999805" stroke="#3D3D3D" />
        <path d="M11 5.40039L0 5.40039" stroke="#3D3D3D" />
      </svg>'); ?>
          </div>
        </div>
      <?php

        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
          comments_template();
        endif;

      endwhile; // End of the loop.
      ?>

    </main><!-- #main -->
  </div><!-- #primary -->
<?php endif; ?>
<?php get_footer(); ?>