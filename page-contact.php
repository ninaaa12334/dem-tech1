<?php get_header(); ?>
<div class="container" style="padding-top:120px; padding-bottom:80px;">
  <h2 class="section-title">Contact</h2>
  <div style="max-width:900px; margin:0 auto;">
    <?php while (have_posts()) : the_post(); the_content(); endwhile; ?>
    <p style="margin-top:25px; color:var(--text-gray);">
      Tip: Add a contact form using any plugin (WPForms / FluentForms / Contact Form 7), then paste the shortcode into this page.
    </p>
  </div>
</div>
<?php get_footer(); ?>
