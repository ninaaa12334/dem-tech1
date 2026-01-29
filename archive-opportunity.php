<?php get_header(); ?>
<section class="featured-blogs" style="padding-top:120px;">
  <div class="container">
    <h2 class="section-title">Volunteer & Internships</h2>

    <div class="blogs-grid">
      <?php if (have_posts()) : while (have_posts()) : the_post();
        $deadline = get_post_meta(get_the_ID(), '_demtech_deadline', true);
      ?>
        <a class="blog-card" href="<?php the_permalink(); ?>" style="text-decoration:none;">
          <div class="blog-content">
            <h3 class="blog-title"><?php the_title(); ?></h3>
            <?php if ($deadline) : ?>
              <p class="blog-description" style="margin-bottom:10px;">Deadline: <?php echo esc_html($deadline); ?></p>
            <?php endif; ?>
            <p class="blog-description"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?></p>
          </div>
        </a>
      <?php endwhile; endif; ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>
