<?php
// Fallback template
get_header();

if (have_posts()) :
  echo '<div class="container" style="padding-top:120px; padding-bottom:80px;">';
  while (have_posts()) : the_post();
    the_title('<h1 style="margin-bottom:20px;">', '</h1>');
    the_content();
  endwhile;
  echo '</div>';
endif;

get_footer();
