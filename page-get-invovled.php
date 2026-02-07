<?php
/* Template Name: Get Involved */
get_header();
?>

<section class="page-hero page-hero--compact">
  <div class="container">
    <h1 class="page-title">Get Involved</h1>
    <p class="page-subtitle">
      Join DemTech to strengthen democratic resilience, counter disinformation, and protect information integrity.
    </p>
  </div>
</section>

<section class="getinvolved-section">
  <div class="container">

    <?php if (isset($_GET['sent']) && $_GET['sent'] === '1'): ?>
      <div class="dm-notice dm-notice--success">
        Thanks — we received your message and will get back to you soon.
      </div>
    <?php elseif (isset($_GET['error']) && $_GET['error'] === '1'): ?>
      <div class="dm-notice dm-notice--error">
        Something went wrong. Please try again.
      </div>
    <?php endif; ?>

    <div class="gi-grid">
      <div class="gi-card">
        <div class="gi-icon">🤝</div>
        <h3 class="gi-title">Volunteer</h3>
        <p class="gi-text">Support events, research, outreach, and digital literacy activities.</p>
        <a class="cta-button" href="#gi-form">Volunteer</a>
      </div>

      <div class="gi-card">
        <div class="gi-icon">🔗</div>
        <h3 class="gi-title">Partner</h3>
        <p class="gi-text">Co-create programs, pilots, convenings, and research with us.</p>
        <a class="cta-button" href="#gi-form">Become a partner</a>
      </div>

      <div class="gi-card">
        <div class="gi-icon">💛</div>
        <h3 class="gi-title">Support Our Work</h3>
        <p class="gi-text">Help sustain initiatives across Kosovo and the Western Balkans.</p>
        <a class="cta-button" href="#gi-form">Support</a>
      </div>
    </div>

    <div id="gi-form" class="gi-form-wrap">
      <div class="gi-form-card">
        <h2 class="gi-h2">Tell us how you want to get involved</h2>
        <p class="gi-text gi-text--muted">Share a few details and we’ll reply soon.</p>

        <form class="gi-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
          <input type="hidden" name="action" value="demtech_get_involved">
          <input type="hidden" name="demtech_nonce" value="<?php echo esc_attr(wp_create_nonce('demtech_get_involved')); ?>">

          <div class="gi-row">
            <div class="gi-field">
              <label for="gi_first">First name*</label>
              <input id="gi_first" name="firstName" type="text" required>
            </div>
            <div class="gi-field">
              <label for="gi_last">Last name*</label>
              <input id="gi_last" name="lastName" type="text" required>
            </div>
          </div>

          <div class="gi-row">
            <div class="gi-field">
              <label for="gi_email">Email*</label>
              <input id="gi_email" name="email" type="email" required>
            </div>
            <div class="gi-field">
              <label for="gi_phone">Phone</label>
              <input id="gi_phone" name="phone" type="tel">
            </div>
          </div>

          <div class="gi-row">
            <div class="gi-field">
              <label for="gi_type">I want to…*</label>
              <select id="gi_type" name="type" required>
                <option value="">Select one</option>
                <option value="volunteer">Volunteer</option>
                <option value="partner">Partner</option>
                <option value="support">Support</option>
                <option value="other">Other</option>
              </select>
            </div>
            <div class="gi-field">
              <label for="gi_org">Organization (optional)</label>
              <input id="gi_org" name="organization" type="text">
            </div>
          </div>

          <div class="gi-field">
            <label for="gi_message">Message*</label>
            <textarea id="gi_message" name="message" rows="6" required></textarea>
          </div>

          <button type="submit" class="submit-button">Send</button>
        </form>

        <p class="gi-note">
          By submitting, you agree we can contact you about your request. We don’t sell your data.
        </p>
      </div>
    </div>

  </div>
</section>

<?php get_footer(); ?>
