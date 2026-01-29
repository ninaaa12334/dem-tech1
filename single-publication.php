<?php get_header(); ?>
<div class="container" style="padding-top:120px; padding-bottom:80px; max-width:900px;">
  <?php while (have_posts()) : the_post(); ?>
    <h2 class="section-title" style="margin-bottom:20px;"><?php the_title(); ?></h2>

    <?php
      $pdf = get_post_meta(get_the_ID(), '_demtech_pdf', true);
      $external = get_post_meta(get_the_ID(), '_demtech_external', true);
      $author = get_post_meta(get_the_ID(), '_demtech_author', true);
    ?>

    <?php if ($author) : ?>
      <p style="color:var(--text-gray); margin-bottom:20px;">By <?php echo esc_html($author); ?></p>
    <?php endif; ?>

    <div style="display:flex; gap:12px; flex-wrap:wrap; margin-bottom:25px;">
      <?php if ($pdf) : ?>
        <a class="cta-button" href="<?php echo esc_url($pdf); ?>" target="_blank" rel="noopener">Download PDF</a>
      <?php endif; ?>
      <?php if ($external) : ?>
        <a class="cta-button" href="<?php echo esc_url($external); ?>" target="_blank" rel="noopener">External Link</a>
      <?php endif; ?>
    </div>

    <div><?php the_content(); ?></div>
  <?php endwhile; ?>
</div>
<?php get_footer(); ?>
