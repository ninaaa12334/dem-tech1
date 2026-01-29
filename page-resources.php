<?php get_header(); ?>
<div class="container" style="padding-top:120px; padding-bottom:80px;">
  <h2 class="section-title">Resources & Insights</h2>

  <div class="blogs-grid">
    <a class="blog-card" href="<?php echo esc_url(get_post_type_archive_link('briefing')); ?>" style="text-decoration:none;">
      <div class="blog-content">
        <h3 class="blog-title">Monthly Briefings</h3>
        <p class="blog-description">Browse briefings by topic and region.</p>
      </div>
    </a>

    <a class="blog-card" href="<?php echo esc_url(get_post_type_archive_link('publication')); ?>" style="text-decoration:none;">
      <div class="blog-content">
        <h3 class="blog-title">Reports & Publications</h3>
        <p class="blog-description">Search publications, download PDFs, and explore insights.</p>
      </div>
    </a>

    <a class="blog-card" href="<?php echo esc_url(get_post_type_archive_link('multimedia')); ?>" style="text-decoration:none;">
      <div class="blog-content">
        <h3 class="blog-title">Multimedia</h3>
        <p class="blog-description">Videos, infographics, and highlights.</p>
      </div>
    </a>

    <a class="blog-card" href="<?php echo esc_url(home_url('/blogs/')); ?>" style="text-decoration:none;">
      <div class="blog-content">
        <h3 class="blog-title">Blog / Analysis</h3>
        <p class="blog-description">Articles and analysis posts.</p>
      </div>
    </a>
  </div>

  <div style="margin-top:50px; max-width:900px; margin-left:auto; margin-right:auto;">
    <?php while (have_posts()) : the_post(); the_content(); endwhile; ?>
  </div>
</div>
<?php get_footer(); ?>
