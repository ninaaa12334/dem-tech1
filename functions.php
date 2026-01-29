<?php
if (!defined('ABSPATH')) exit;

function demtech_assets() {
  wp_enqueue_style('demtech-style', get_stylesheet_uri(), [], '1.0');
}
add_action('wp_enqueue_scripts', 'demtech_assets');

function demtech_setup() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'demtech_setup');

/**
 * Create subscribers table when theme is activated
 * Table name will be: wp_demtech_subscribers (or your custom prefix)
 */
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

/**
 * Handle Subscribe form submission
 */
function demtech_handle_subscribe() {
  // Verify nonce
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

  // Insert or ignore duplicate email
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

  // Redirect back to subscribe section (with a success flag)
  wp_safe_redirect(home_url('/#subscribe'));
  exit;
}

// public (not logged in) + logged in
add_action('admin_post_nopriv_demtech_subscribe', 'demtech_handle_subscribe');
add_action('admin_post_demtech_subscribe', 'demtech_handle_subscribe');
