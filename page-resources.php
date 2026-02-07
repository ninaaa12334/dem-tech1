<?php
/* Template Name: Resources */
get_header();
?>

<main class="page-resources">

  <!-- HERO -->
  <section class="resources-hero">
    <div class="container">
      <h1 class="page-title">Resources</h1>
      <p class="page-lead">
        Reports, toolkits, guides, and practical materials on democracy, technology, and information integrity.
      </p>

      <div class="resources-search">
        <input id="resourceSearch" type="text" placeholder="Search resources..." />
      </div>
    </div>
  </section>

  <!-- GRID -->
  <section class="resources-section">
    <div class="container">

      <div class="resources-grid" id="resourcesGrid">

        <!-- Card 1 -->
        <article class="resource-card" data-title="Information Integrity Toolkit" data-tags="toolkit disinformation media literacy">
          <div class="resource-top">
            <span class="resource-badge">Toolkit</span>
            <span class="resource-tag">Information Integrity</span>
          </div>
          <h3 class="resource-title">Information Integrity Toolkit</h3>
          <p class="resource-desc">
            Practical steps for identifying, responding to, and reducing the impact of disinformation.
          </p>
          <div class="resource-actions">
            <a class="resource-link" href="#" target="_blank" rel="noopener">Download PDF</a>
            <a class="resource-link secondary" href="#">Read more</a>
          </div>
        </article>

        <!-- Card 2 -->
        <article class="resource-card" data-title="AI for Civic Participation" data-tags="ai youth participation policy">
          <div class="resource-top">
            <span class="resource-badge">Guide</span>
            <span class="resource-tag">AI & Democracy</span>
          </div>
          <h3 class="resource-title">AI for Civic Participation</h3>
          <p class="resource-desc">
            A plain-language guide on using AI responsibly to support civic engagement and public dialogue.
          </p>
          <div class="resource-actions">
            <a class="resource-link" href="#" target="_blank" rel="noopener">Open</a>
            <a class="resource-link secondary" href="#">Read more</a>
          </div>
        </article>

        <!-- Card 3 -->
        <article class="resource-card" data-title="Election Tech Risk Checklist" data-tags="elections security cyber checklist">
          <div class="resource-top">
            <span class="resource-badge">Checklist</span>
            <span class="resource-tag">Election Security</span>
          </div>
          <h3 class="resource-title">Election Tech Risk Checklist</h3>
          <p class="resource-desc">
            A quick checklist to help campaigns and institutions spot digital risks and improve resilience.
          </p>
          <div class="resource-actions">
            <a class="resource-link" href="#" target="_blank" rel="noopener">Download</a>
            <a class="resource-link secondary" href="#">Read more</a>
          </div>
        </article>

      </div>
    </div>
  </section>

</main>

<script>
  // Simple client-side search (title + tags)
  (function () {
    const input = document.getElementById("resourceSearch");
    const cards = Array.from(document.querySelectorAll(".resource-card"));

    if (!input) return;

    input.addEventListener("input", () => {
      const q = input.value.trim().toLowerCase();
      cards.forEach(card => {
        const title = (card.dataset.title || "").toLowerCase();
        const tags  = (card.dataset.tags || "").toLowerCase();
        const match = !q || title.includes(q) || tags.includes(q);
        card.style.display = match ? "" : "none";
      });
    });
  })();
</script>

<?php get_footer(); ?>
