<?php get_header(); ?>
<div class="container" style="padding-top:120px; padding-bottom:80px; max-width:900px;">
  <?php while (have_posts()) : the_post(); ?>
    <h2 class="section-title" style="margin-bottom:20px;"><?php the_title(); ?></h2>

    <?php
      $deadline = get_post_meta(get_the_ID(), '_demtech_deadline', true);
      $apply = get_post_meta(get_the_ID(), '_demtech_apply', true);
    ?>

    <?php if ($deadline) : ?>
      <p style="color:var(--text-gray); margin-bottom:20px;">Deadline: <?php echo esc_html($deadline); ?></p>
    <?php endif; ?>

    <?php if ($apply) : ?>
      <p style="margin-bottom:25px;">
        <a class="cta-button" href="<?php echo esc_url($apply); ?>" target="_blank" rel="noopener">Apply</a>
      </p>
    <?php endif; ?>

    <div><?php the_content(); ?></div>
  <?php endwhile; ?>
</div>
<?php get_footer(); ?>
