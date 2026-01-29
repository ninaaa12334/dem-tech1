<?php get_header(); ?>
<div class="container" style="padding-top:120px; padding-bottom:80px; max-width:900px;">
  <?php while (have_posts()) : the_post(); ?>
    <h2 class="section-title" style="margin-bottom:20px;"><?php the_title(); ?></h2>

    <?php
      $video = get_post_meta(get_the_ID(), '_demtech_video', true);
      $external = get_post_meta(get_the_ID(), '_demtech_external', true);
    ?>

    <?php if ($video) : ?>
      <div style="margin-bottom:25px;">
        <?php echo wp_oembed_get($video); ?>
      </div>
    <?php endif; ?>

    <?php if ($external) : ?>
      <p style="margin-bottom:25px;">
        <a class="cta-button" href="<?php echo esc_url($external); ?>" target="_blank" rel="noopener">Open Link</a>
      </p>
    <?php endif; ?>

    <div><?php the_content(); ?></div>
  <?php endwhile; ?>
</div>
<?php get_footer(); ?>
