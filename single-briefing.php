<?php get_header(); ?>
<div class="container" style="padding-top:120px; padding-bottom:80px; max-width:900px;">
  <?php while (have_posts()) : the_post(); ?>
    <h2 class="section-title" style="margin-bottom:20px;"><?php the_title(); ?></h2>

    <?php
      $pdf = get_post_meta(get_the_ID(), '_demtech_pdf', true);
      $month = get_post_meta(get_the_ID(), '_demtech_month', true);
      $year = get_post_meta(get_the_ID(), '_demtech_year', true);
    ?>

    <p style="color:var(--text-gray); margin-bottom:20px;">
      <?php echo esc_html(trim($month . ' ' . $year)); ?>
    </p>

    <?php if ($pdf) : ?>
      <p style="margin-bottom:25px;">
        <a class="cta-button" href="<?php echo esc_url($pdf); ?>" target="_blank" rel="noopener">Download PDF</a>
      </p>
    <?php endif; ?>

    <div><?php the_content(); ?></div>
  <?php endwhile; ?>
</div>
<?php get_footer(); ?>
