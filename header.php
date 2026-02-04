<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(''); ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="logo-section">
                <div class="logo-icon">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 5L25 10L20 15L15 10L20 5Z" stroke="currentColor" stroke-width="2" fill="none"/>
                        <path d="M10 20L15 25L10 30L5 25L10 20Z" stroke="currentColor" stroke-width="2" fill="none"/>
                        <path d="M30 20L35 25L30 30L25 25L30 20Z" stroke="currentColor" stroke-width="2" fill="none"/>
                        <path d="M20 25L25 30L20 35L15 30L20 25Z" stroke="currentColor" stroke-width="2" fill="none"/>
                        <line x1="20" y1="5" x2="20" y2="15" stroke="currentColor" stroke-width="2"/>
                        <line x1="20" y1="25" x2="20" y2="35" stroke="currentColor" stroke-width="2"/>
                        <line x1="10" y1="20" x2="20" y2="20" stroke="currentColor" stroke-width="2"/>
                        <line x1="20" y1="20" x2="30" y2="20" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <div class="logo-text">
                    <h1 class="logo-title">DEMTECH</h1>
                    <p class="logo-subtitle">Democracy & Technology</p>
                </div>
            </div>
         <nav class="nav-menu">
  <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-link">Home</a>
  <a href="<?php echo esc_url(home_url('/about/')); ?>" class="nav-link">About</a>
  <a href="<?php echo esc_url(home_url('/what-we-do/')); ?>" class="nav-link">What We Do</a>
  <a href="<?php echo esc_url(home_url('/resources/')); ?>" class="nav-link">Resources</a>
  <a href="<?php echo esc_url(home_url('/events/')); ?>" class="nav-link">Events</a>
  <a href="<?php echo esc_url(home_url('/partners/')); ?>" class="nav-link">Partners</a>
  <a href="<?php echo esc_url(home_url('/get-involved/')); ?>" class="nav-link">Get Involved</a>
  <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="nav-link">Contact</a>
</nav>

        </div>
    </header>
