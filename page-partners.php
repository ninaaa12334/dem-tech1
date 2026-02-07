<?php
/* Template Name: Partners */
get_header();
?>

<section class="page-hero page-hero--compact">
  <div class="container">
    <h1 class="page-title">Partners</h1>
    <p class="page-subtitle">
      We collaborate with institutions, civil society, and research partners to strengthen democratic resilience in the digital age.
    </p>
  </div>
</section>

<section class="partners-section">
  <div class="container">

    <?php
      // Edit these anytime (names, descriptions, links, logos).
      $partners = [
        [
          'name' => 'UNMIK',
          'desc' => 'Collaboration on civic resilience, peacebuilding, and information integrity initiatives.',
          'url'  => '#',
          'logo' => get_template_directory_uri() . '/assets/partners/unmik.png',
        ],
        [
          'name' => 'UN Agencies',
          'desc' => 'Partnerships supporting inclusive governance, media integrity, and digital safety programs.',
          'url'  => '#',
          'logo' => get_template_directory_uri() . '/assets/partners/un-agencies.png',
        ],
        [
          'name' => 'Democracy Plus (D+)',
          'desc' => 'Joint work to strengthen accountable institutions and informed public participation.',
          'url'  => '#',
          'logo' => get_template_directory_uri() . '/assets/partners/dplus.png',
        ],
        [
          'name' => 'Regional CSOs',
          'desc' => 'Cooperation across the Western Balkans to monitor narratives, share methods, and build capacity.',
          'url'  => '#',
          'logo' => get_template_directory_uri() . '/assets/partners/regional-csos.png',
        ],
        [
          'name' => 'International Research Institutions',
          'desc' => 'Research partnerships to advance evidence-based policy and analysis on digital influence.',
          'url'  => '#',
          'logo' => get_template_directory_uri() . '/assets/partners/research.png',
        ],
      ];
    ?>

    <div class="partners-grid">
      <?php foreach ($partners as $p): ?>
        <a class="partner-card" href="<?php echo esc_url($p['url']); ?>" target="_blank" rel="noopener">
          <div class="partner-logo">
            <img src="<?php echo esc_url($p['logo']); ?>" alt="<?php echo esc_attr($p['name']); ?>">
          </div>
          <div class="partner-body">
            <h3 class="partner-name"><?php echo esc_html($p['name']); ?></h3>
            <p class="partner-desc"><?php echo esc_html($p['desc']); ?></p>
          </div>
        </a>
      <?php endforeach; ?>
    </div>

    <div class="partner-callout">
      <div class="callout-inner">
        <h2>Partner With Us</h2>
        <p>
          DemTech collaborates with civil society, international agencies, research institutions, and media platforms to strengthen democratic resilience.
          If you’re interested in working together, please reach out.
        </p>
        <div class="callout-actions">
          <a class="cta-button" href="<?php echo esc_url(site_url('/contact')); ?>">Contact us</a>
          <a class="cta-button cta-button--ghost" href="<?php echo esc_url(site_url('/get-involved')); ?>">Get involved</a>
        </div>
      </div>
    </div>

  </div>
</section>

<?php get_footer(); ?>
