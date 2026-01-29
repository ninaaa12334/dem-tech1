<?php get_header(); ?>
<div class="container" style="padding-top:120px; padding-bottom:80px; max-width:900px;">
  <?php while (have_posts()) : the_post(); ?>
    <h2 class="section-title" style="margin-bottom:20px;"><?php the_title(); ?></h2>

    <?php
      $date = get_post_meta(get_the_ID(), '_demtech_event_date', true);
      $time = get_post_meta(get_the_ID(), '_demtech_event_time', true);
      $location = get_post_meta(get_the_ID(), '_demtech_location', true);
      $register = get_post_meta(get_the_ID(), '_demtech_register', true);
    ?>

    <p style="color:var(--text-gray); margin-bottom:20px;">
      <?php echo esc_html(trim($date . ' ' . $time)); ?> • <?php echo esc_html($location); ?>
    </p>

    <?php if ($register) : ?>
      <p style="margin-bottom:25px;">
        <a class="cta-button" href="<?php echo esc_url($register); ?>" target="_blank" rel="noopener">Register</a>
      </p>
    <?php endif; ?>

    <div><?php the_content(); ?></div>
  <?php endwhile; ?>
</div>
<?php get_footer(); ?>
