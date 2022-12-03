<?php get_header(); ?>
<div class="content" id="content">
  <div class="site__content">
    <div class="container">
      <div class="post__all__home">
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); ?>
            <article class="item">
              <?php $thumbnail = get_the_post_thumbnail_url(); ?>
              <div class="item__thumbnail">
                <a href="<?php the_permalink(); ?>">
                  <?php if ($thumbnail) : ?>
                    <?php echo get_the_post_thumbnail(get_the_id(), 'full', array('class' => 'thumnail')); ?>
                  <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/no-image.png" alt="<?php the_title(); ?>">
                  <?php endif; ?>
                </a>
              </div>
              <div class="item__content">
                <a href="<?php the_permalink(); ?>">
                  <h2><?php the_title(); ?></h2>
                </a>
                <p class="desc">
                  <?php
                  $theExcerpt = get_the_excerpt();
                  if (strlen($theExcerpt) > 120) {
                    echo substr($theExcerpt, 0, 120) . '...';
                  } else {
                    echo $theExcerpt;
                  }
                  ?>
                </p>
                <div class="item__time d-flex align-items-center justify-between">
                  <p><?php echo prefix_estimated_reading_time(); ?> phút đọc</p>
                  <p class="item__time__date"><?php echo get_the_date('j F, Y') ?></p>
                </div>
              </div>
            </article>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
      <!-- paginate -->
      <?php if (paginate_links() != '') {
      ?>
        <div class="tvc_paginate">
          <?php
          global $wp_query;
          $big = 999999999;
          echo paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'prev_text' => __('«'),
            'next_text' => __('»'),
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages
          ));
          ?>
        </div>
      <?php
      }
      ?>

    </div>
  </div>
</div>
<?php get_footer(); ?>