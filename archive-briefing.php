<?php get_header(); ?>
<section class="featured-blogs" style="padding-top:120px;">
  <div class="container">
    <h2 class="section-title">Monthly Briefings</h2>

    <div class="blogs-grid">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <a class="blog-card" href="<?php the_permalink(); ?>" style="text-decoration:none;">
          <div class="blog-image">
            <?php if (has_post_thumbnail()) : the_post_thumbnail('large'); endif; ?>
          </div>
          <div class="blog-content">
            <h3 class="blog-title"><?php the_title(); ?></h3>
            <p class="blog-description"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?></p>
          </div>
        </a>
      <?php endwhile; endif; ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>
