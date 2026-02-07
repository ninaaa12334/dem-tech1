<?php
if (!defined('ABSPATH')) exit;

/* =========================
   1) ASSETS (CSS)
========================= */
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style(
    'demtech-style',
    get_stylesheet_uri(),
    [],
    file_exists(get_stylesheet_directory() . '/style.css')
      ? filemtime(get_stylesheet_directory() . '/style.css')
      : '1.0'
  );
});

/* =========================
   2) THEME SUPPORT
========================= */
add_action('after_setup_theme', function () {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
});

/* =========================
   3) SUBSCRIBE: DB TABLE + HANDLER
========================= */
function demtech_create_subscribers_table() {
  global $wpdb;
  $table = $wpdb->prefix . 'demtech_subscribers';
  $charset = $wpdb->get_charset_collate();

  require_once ABSPATH . 'wp-admin/includes/upgrade.php';

  $sql = "CREATE TABLE $table (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(190) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY email (email)
  ) $charset;";

  dbDelta($sql);
}
add_action('after_switch_theme', 'demtech_create_subscribers_table');

function demtech_handle_subscribe() {
  if (!isset($_POST['demtech_nonce']) || !wp_verify_nonce($_POST['demtech_nonce'], 'demtech_subscribe')) {
    wp_die('Invalid request.');
  }

  $first = sanitize_text_field($_POST['firstName'] ?? '');
  $last  = sanitize_text_field($_POST['lastName'] ?? '');
  $email = sanitize_email($_POST['email'] ?? '');
  $phone = sanitize_text_field($_POST['phone'] ?? '');

  if (!$first || !$last || !$email || !$phone) {
    wp_safe_redirect(home_url('/#subscribe'));
    exit;
  }

  global $wpdb;
  $table = $wpdb->prefix . 'demtech_subscribers';

  $existing = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE email = %s", $email));
  if (!$existing) {
    $wpdb->insert(
      $table,
      [
        'first_name' => $first,
        'last_name'  => $last,
        'email'      => $email,
        'phone'      => $phone,
      ],
      ['%s','%s','%s','%s']
    );
  }

  wp_safe_redirect(home_url('/#subscribe'));
  exit;
}
add_action('admin_post_nopriv_demtech_subscribe', 'demtech_handle_subscribe');
add_action('admin_post_demtech_subscribe', 'demtech_handle_subscribe');


/* =========================
   4) CPTs + TAXONOMIES
========================= */
add_action('init', function () {

  // ---- TAXONOMIES ----
  register_taxonomy('demtech_topic', ['briefing','publication','multimedia','event','opportunity'], [
    'labels' => [
      'name' => 'Topics',
      'singular_name' => 'Topic',
    ],
    'public' => true,
    'hierarchical' => true,
    'show_admin_column' => true,
    'rewrite' => ['slug' => 'topic'],
  ]);

  register_taxonomy('demtech_region', ['briefing','publication','multimedia','event','opportunity'], [
    'labels' => [
      'name' => 'Regions',
      'singular_name' => 'Region',
    ],
    'public' => true,
    'hierarchical' => true,
    'show_admin_column' => true,
    'rewrite' => ['slug' => 'region'],
  ]);

  register_taxonomy('demtech_type', ['publication','multimedia','opportunity'], [
    'labels' => [
      'name' => 'Types',
      'singular_name' => 'Type',
    ],
    'public' => true,
    'hierarchical' => true,
    'show_admin_column' => true,
    'rewrite' => ['slug' => 'type'],
  ]);

  // ---- CPT: BRIEFINGS ----
  register_post_type('briefing', [
    'labels' => [
      'name' => 'Monthly Briefings',
      'singular_name' => 'Briefing',
      'add_new_item' => 'Add New Briefing',
      'edit_item' => 'Edit Briefing',
    ],
    'public' => true,
    'menu_icon' => 'dashicons-media-document',
    'has_archive' => true,
    'rewrite' => ['slug' => 'briefings'],
    'supports' => ['title','editor','thumbnail','excerpt'],
    'show_in_rest' => true,
  ]);

  // ---- CPT: PUBLICATIONS ----
  register_post_type('publication', [
    'labels' => [
      'name' => 'Publications',
      'singular_name' => 'Publication',
      'add_new_item' => 'Add New Publication',
      'edit_item' => 'Edit Publication',
    ],
    'public' => true,
    'menu_icon' => 'dashicons-book-alt',
    'has_archive' => true,
    'rewrite' => ['slug' => 'publications'],
    'supports' => ['title','editor','thumbnail','excerpt'],
    'show_in_rest' => true,
  ]);

  // ---- CPT: EVENTS ----
  register_post_type('event', [
    'labels' => [
      'name' => 'Events & Trainings',
      'singular_name' => 'Event',
      'add_new_item' => 'Add New Event',
      'edit_item' => 'Edit Event',
    ],
    'public' => true,
    'menu_icon' => 'dashicons-calendar-alt',
    'has_archive' => true,
    'rewrite' => ['slug' => 'events'],
    'supports' => ['title','editor','thumbnail','excerpt'],
    'show_in_rest' => true,
  ]);

  // ---- CPT: MULTIMEDIA ----
  register_post_type('multimedia', [
    'labels' => [
      'name' => 'Multimedia',
      'singular_name' => 'Multimedia Item',
      'add_new_item' => 'Add New Multimedia',
      'edit_item' => 'Edit Multimedia',
    ],
    'public' => true,
    'menu_icon' => 'dashicons-video-alt3',
    'has_archive' => true,
    'rewrite' => ['slug' => 'multimedia'],
    'supports' => ['title','editor','thumbnail','excerpt'],
    'show_in_rest' => true,
  ]);

  // ---- CPT: OPPORTUNITIES ----
  register_post_type('opportunity', [
    'labels' => [
      'name' => 'Opportunities',
      'singular_name' => 'Opportunity',
      'add_new_item' => 'Add New Opportunity',
      'edit_item' => 'Edit Opportunity',
    ],
    'public' => true,
    'menu_icon' => 'dashicons-groups',
    'has_archive' => true,
    'rewrite' => ['slug' => 'opportunities'],
    'supports' => ['title','editor','thumbnail','excerpt'],
    'show_in_rest' => true,
  ]);
});


/* =========================
   5) META BOXES (FIELDS)
========================= */
function demtech_meta_field($post_id, $key) {
  $v = get_post_meta($post_id, $key, true);
  return is_string($v) ? $v : '';
}

add_action('add_meta_boxes', function () {

  add_meta_box('demtech_briefing_fields', 'Briefing Details', function ($post) {
    $pdf = esc_url(demtech_meta_field($post->ID, '_demtech_pdf'));
    $month = esc_attr(demtech_meta_field($post->ID, '_demtech_month'));
    $year = esc_attr(demtech_meta_field($post->ID, '_demtech_year'));
    wp_nonce_field('demtech_save_meta', 'demtech_meta_nonce');
    echo '<p><label>PDF URL</label><br><input style="width:100%" name="demtech_pdf" value="'.$pdf.'" placeholder="https://...pdf"></p>';
    echo '<p><label>Month</label><br><input style="width:100%" name="demtech_month" value="'.$month.'" placeholder="e.g., January"></p>';
    echo '<p><label>Year</label><br><input style="width:100%" name="demtech_year" value="'.$year.'" placeholder="e.g., 2026"></p>';
  }, 'briefing', 'normal', 'high');

  add_meta_box('demtech_publication_fields', 'Publication Details', function ($post) {
    $pdf = esc_url(demtech_meta_field($post->ID, '_demtech_pdf'));
    $ext = esc_url(demtech_meta_field($post->ID, '_demtech_external'));
    $author = esc_attr(demtech_meta_field($post->ID, '_demtech_author'));
    wp_nonce_field('demtech_save_meta', 'demtech_meta_nonce');
    echo '<p><label>PDF URL</label><br><input style="width:100%" name="demtech_pdf" value="'.$pdf.'" placeholder="https://...pdf"></p>';
    echo '<p><label>External Link (optional)</label><br><input style="width:100%" name="demtech_external" value="'.$ext.'" placeholder="https://..."></p>';
    echo '<p><label>Author (optional)</label><br><input style="width:100%" name="demtech_author" value="'.$author.'" placeholder="Name"></p>';
  }, 'publication', 'normal', 'high');

  add_meta_box('demtech_event_fields', 'Event Details', function ($post) {
    $date = esc_attr(demtech_meta_field($post->ID, '_demtech_event_date')); // YYYY-MM-DD
    $time = esc_attr(demtech_meta_field($post->ID, '_demtech_event_time')); // HH:MM
    $location = esc_attr(demtech_meta_field($post->ID, '_demtech_location'));
    $reg = esc_url(demtech_meta_field($post->ID, '_demtech_register'));
    wp_nonce_field('demtech_save_meta', 'demtech_meta_nonce');
    echo '<p><label>Date (YYYY-MM-DD)</label><br><input style="width:100%" name="demtech_event_date" value="'.$date.'" placeholder="2026-01-29"></p>';
    echo '<p><label>Time (HH:MM)</label><br><input style="width:100%" name="demtech_event_time" value="'.$time.'" placeholder="18:00"></p>';
    echo '<p><label>Location</label><br><input style="width:100%" name="demtech_location" value="'.$location.'" placeholder="Prishtina / Online"></p>';
    echo '<p><label>Registration Link (optional)</label><br><input style="width:100%" name="demtech_register" value="'.$reg.'" placeholder="https://..."></p>';
  }, 'event', 'normal', 'high');

  add_meta_box('demtech_multimedia_fields', 'Multimedia Details', function ($post) {
    $video = esc_url(demtech_meta_field($post->ID, '_demtech_video'));
    $ext = esc_url(demtech_meta_field($post->ID, '_demtech_external'));
    wp_nonce_field('demtech_save_meta', 'demtech_meta_nonce');
    echo '<p><label>Video URL (YouTube/Vimeo)</label><br><input style="width:100%" name="demtech_video" value="'.$video.'" placeholder="https://youtube.com/..."></p>';
    echo '<p><label>External Link (optional)</label><br><input style="width:100%" name="demtech_external" value="'.$ext.'" placeholder="https://..."></p>';
  }, 'multimedia', 'normal', 'high');

  add_meta_box('demtech_opportunity_fields', 'Opportunity Details', function ($post) {
    $deadline = esc_attr(demtech_meta_field($post->ID, '_demtech_deadline')); // YYYY-MM-DD
    $apply = esc_url(demtech_meta_field($post->ID, '_demtech_apply'));
    wp_nonce_field('demtech_save_meta', 'demtech_meta_nonce');
    echo '<p><label>Deadline (YYYY-MM-DD)</label><br><input style="width:100%" name="demtech_deadline" value="'.$deadline.'" placeholder="2026-02-15"></p>';
    echo '<p><label>Apply Link (optional)</label><br><input style="width:100%" name="demtech_apply" value="'.$apply.'" placeholder="https://..."></p>';
  }, 'opportunity', 'normal', 'high');
});

add_action('save_post', function ($post_id) {
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
  if (!isset($_POST['demtech_meta_nonce']) || !wp_verify_nonce($_POST['demtech_meta_nonce'], 'demtech_save_meta')) return;

  $map = [
    'demtech_pdf' => '_demtech_pdf',
    'demtech_month' => '_demtech_month',
    'demtech_year' => '_demtech_year',
    'demtech_external' => '_demtech_external',
    'demtech_author' => '_demtech_author',
    'demtech_event_date' => '_demtech_event_date',
    'demtech_event_time' => '_demtech_event_time',
    'demtech_location' => '_demtech_location',
    'demtech_register' => '_demtech_register',
    'demtech_video' => '_demtech_video',
    'demtech_deadline' => '_demtech_deadline',
    'demtech_apply' => '_demtech_apply',
  ];

  foreach ($map as $field => $meta_key) {
    if (isset($_POST[$field])) {
      $val = $_POST[$field];
      if (str_contains($meta_key, 'pdf') || str_contains($meta_key, 'external') || str_contains($meta_key, 'register') || str_contains($meta_key, 'video') || str_contains($meta_key, 'apply')) {
        $val = esc_url_raw($val);
      } else {
        $val = sanitize_text_field($val);
      }
      update_post_meta($post_id, $meta_key, $val);
    }
  }
});

/* =========================
   6) EVENTS: ORDER UPCOMING FIRST
========================= */
add_action('pre_get_posts', function ($q) {
  if (is_admin() || !$q->is_main_query()) return;

  if ($q->is_post_type_archive('event')) {
    $q->set('meta_key', '_demtech_event_date');
    $q->set('orderby', 'meta_value');
    $q->set('order', 'ASC');
  }
});

add_action('admin_post_nopriv_demtech_get_involved', 'demtech_handle_get_involved');
add_action('admin_post_demtech_get_involved', 'demtech_handle_get_involved');

function demtech_handle_get_involved() {
  // Nonce check
  if (!isset($_POST['demtech_nonce']) || !wp_verify_nonce($_POST['demtech_nonce'], 'demtech_get_involved')) {
    wp_safe_redirect(home_url('/get-involved/?error=1'));
    exit;
  }

  // Sanitize
  $first = sanitize_text_field($_POST['firstName'] ?? '');
  $last  = sanitize_text_field($_POST['lastName'] ?? '');
  $email = sanitize_email($_POST['email'] ?? '');
  $phone = sanitize_text_field($_POST['phone'] ?? '');
  $type  = sanitize_text_field($_POST['type'] ?? '');
  $org   = sanitize_text_field($_POST['organization'] ?? '');
  $msg   = sanitize_textarea_field($_POST['message'] ?? '');

  // Basic validation
  if (empty($first) || empty($last) || empty($email) || empty($type) || empty($msg) || !is_email($email)) {
    wp_safe_redirect(home_url('/get-involved/?error=1'));
    exit;
  }

  // Email content
  $to = get_option('admin_email');
  $subject = 'DemTech Get Involved: ' . strtoupper($type);
  $body =
    "Name: $first $last\n" .
    "Email: $email\n" .
    "Phone: $phone\n" .
    "Type: $type\n" .
    "Organization: $org\n\n" .
    "Message:\n$msg\n";

  $headers = [];
  $headers[] = 'Content-Type: text/plain; charset=UTF-8';
  $headers[] = 'Reply-To: ' . $email;

  $sent = wp_mail($to, $subject, $body, $headers);

  wp_safe_redirect(home_url('/get-involved/?' . ($sent ? 'sent=1' : 'error=1')));
  exit;
}
function demtech_events_styles() {
  if (is_page_template('page-events.php')) {
    wp_enqueue_style(
      'demtech-events',
      get_stylesheet_directory_uri() . '/assets/css/events.css',
      array(),
      filemtime(get_stylesheet_directory() . '/assets/css/events.css')
    );
  }
}
add_action('wp_enqueue_scripts', 'demtech_events_styles');
