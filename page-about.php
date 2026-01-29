<?php get_header(); ?>
<div class="container" style="padding-top:120px; padding-bottom:80px;">
  <h2 class="section-title">About Us</h2>
  <div style="max-width:900px; margin:0 auto;">
    <?php while (have_posts()) : the_post(); the_content(); endwhile; ?>
  </div>
</div>
<?php get_footer(); ?>
