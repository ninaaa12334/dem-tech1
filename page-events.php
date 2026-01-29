<?php get_header(); ?>
<div class="container" style="padding-top:120px; padding-bottom:80px;">
  <h2 class="section-title">Events & Trainings</h2>

  <p style="text-align:center; margin-top:-20px; color:var(--text-gray);">
    Upcoming and past events.
  </p>

  <div style="text-align:center; margin: 20px 0 40px;">
    <a class="cta-button" href="<?php echo esc_url(get_post_type_archive_link('event')); ?>">View All Events</a>
  </div>

  <div style="max-width:900px; margin:0 auto;">
    <?php while (have_posts()) : the_post(); the_content(); endwhile; ?>
  </div>
</div>
<?php get_footer(); ?>
