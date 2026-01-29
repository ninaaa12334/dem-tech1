<?php get_header(); ?>
<div class="container" style="padding-top:120px; padding-bottom:80px;">
  <h2 class="section-title">Get Involved</h2>

  <div class="blogs-grid" style="margin-top:30px;">
    <a class="blog-card" href="<?php echo esc_url(home_url('/#subscribe')); ?>" style="text-decoration:none;">
      <div class="blog-content">
        <h3 class="blog-title">Subscribe</h3>
        <p class="blog-description">Get updates and insights.</p>
      </div>
    </a>

    <a class="blog-card" href="<?php echo esc_url(get_post_type_archive_link('opportunity')); ?>" style="text-decoration:none;">
      <div class="blog-content">
        <h3 class="blog-title">Volunteer & Internships</h3>
        <p class="blog-description">Explore open opportunities.</p>
      </div>
    </a>

    <a class="blog-card" href="<?php echo esc_url(home_url('/contact/')); ?>" style="text-decoration:none;">
      <div class="blog-content">
        <h3 class="blog-title">Partner With Us</h3>
        <p class="blog-description">Reach out to collaborate.</p>
      </div>
    </a>
  </div>

  <div style="margin-top:50px; max-width:900px; margin-left:auto; margin-right:auto;">
    <?php while (have_posts()) : the_post(); the_content(); endwhile; ?>
  </div>
</div>
<?php get_footer(); ?>
