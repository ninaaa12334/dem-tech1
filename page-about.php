<?php get_header(); ?>

<main class="demtech-page about-page">
  <section class="about-hero">
    <div class="container">
      <p class="about-kicker">ABOUT DEMTECH</p>
      <h2 class="about-title">Democracy and Technology</h2>
      <p class="about-lead">
        DemTech is a non-partisan, independent civil society organization dedicated to strengthening democratic
        resilience in the digital era. We monitor digital threats, counter disinformation, support peaceful civic
        engagement, and help societies adapt to the rapid evolution of information technologies.
      </p>
    </div>
  </section>

  <section class="about-section">
    <div class="container">
      <div class="about-grid-2">
        <article class="about-card">
          <h3 class="about-card-title">Mission</h3>
          <p class="about-text">
            At DemTech, our mission is to strengthen democratic resilience by understanding and responding to the
            challenges posed by digital technologies. We monitor the online information environment, analyze foreign
            influence and disinformation, and support informed, peaceful public discourse in Kosovo and the Western Balkans.
          </p>
        </article>

        <article class="about-card">
          <h3 class="about-card-title">Vision</h3>
          <p class="about-text">
            We envision inclusive, informed, and resilient democratic societies where technology empowers citizens,
            protects human dignity, fosters trust, and supports peaceful coexistence—rather than undermining trust, peace,
            or community relations.
          </p>
        </article>
      </div>
    </div>
  </section>

  <section class="about-section about-values">
    <div class="container">
      <h3 class="about-section-title">Our Values</h3>

      <div class="about-grid-4">
        <article class="value-card">
          <h4 class="value-title">Democracy & Pluralism</h4>
          <p class="value-text">Upholding democratic rights, human dignity, and equality.</p>
        </article>

        <article class="value-card">
          <h4 class="value-title">Integrity & Evidence</h4>
          <p class="value-text">Research-driven, unbiased analysis to inform actions.</p>
        </article>

        <article class="value-card">
          <h4 class="value-title">Peace & Cohesion</h4>
          <p class="value-text">Prioritizing social harmony and conflict avoidance.</p>
        </article>

        <article class="value-card">
          <h4 class="value-title">Innovation</h4>
          <p class="value-text">Using cutting-edge tools to understand digital trends.</p>
        </article>
      </div>
    </div>
  </section>

  <section class="about-section">
    <div class="container">
      <div class="about-grid-2">
        <article class="about-card">
          <h3 class="about-card-title">Our Team</h3>
          <p class="about-text">
            DemTech brings together analysts, researchers, and technology specialists focused on protecting democratic
            trust and strengthening public resilience against digital harms.
          </p>

          <div class="team-grid">
            <div class="team-card">
              <div class="team-photo"></div>
              <div class="team-meta">
                <p class="team-name">Analyst</p>
                <p class="team-role">Information Environment Monitoring</p>
              </div>
            </div>

            <div class="team-card">
              <div class="team-photo"></div>
              <div class="team-meta">
                <p class="team-name">Researcher</p>
                <p class="team-role">Research & Publications</p>
              </div>
            </div>

            <div class="team-card">
              <div class="team-photo"></div>
              <div class="team-meta">
                <p class="team-name">Tech Specialist</p>
                <p class="team-role">Tools, Data, and Innovation</p>
              </div>
            </div>
          </div>
        </article>

        <article class="about-card">
          <h3 class="about-card-title">Advisory Board</h3>
          <p class="about-text">
            DemTech is supported by experts in democracy, technology, peacebuilding, and media who provide strategic
            guidance and technical insight.
          </p>

          <ul class="about-list">
            <li>Democracy and governance expertise</li>
            <li>Technology and AI policy expertise</li>
            <li>Peacebuilding and social cohesion expertise</li>
            <li>Media and information integrity expertise</li>
          </ul>
        </article>
      </div>
    </div>
  </section>

  <section class="about-section about-cta">
    <div class="container">
      <div class="cta-box">
        <h3 class="cta-title">Work With Us</h3>
        <p class="cta-text">
          DemTech collaborates with civil society, international agencies, research institutions, and media platforms
          to strengthen democratic resilience. If you’re interested in working together, please reach out.
        </p>
        <a class="cta-button" href="<?php echo esc_url(home_url('/contact/')); ?>">Contact Us</a>
      </div>
    </div>
  </section>

  <?php
    // Optional: if you ever decide to add extra WordPress editor content later, it will show here.
    // Leave the About page content empty if you want.
    if (have_posts()) : while (have_posts()) : the_post();
      $content = trim(get_the_content());
      if (!empty($content)) :
  ?>
    <section class="about-section">
      <div class="container about-wp-content">
        <?php the_content(); ?>
      </div>
    </section>
  <?php
      endif;
    endwhile; endif;
  ?>

</main>

<?php get_footer(); ?>
