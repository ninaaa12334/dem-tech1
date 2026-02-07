<?php get_header(); ?>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-content">
            <h1 class="hero-main-title">Democracy & Technology</h1>
            <h2 class="hero-large-title">Protecting Democracy in the Digital Age </h2>
            <p class="hero-subtitle">Strengthening democratic resilience, countering disinformation, and safeguarding information integrity across Kosovo and the Western Balkans.</p>
            <div class="hero-divider"></div>
            <a href="#blogs" class="cta-button">Read Blogs</a>
        </div>
        
    </section>

    <!-- Featured Blogs Section -->
    <section id="blogs" class="featured-blogs">
        <div class="container">
            <h2 class="section-title">Featured Blogs</h2>
            <div class="blogs-grid">

                <?php
                $fallback_images = [
                    "https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=400&h=250&fit=crop",
                    "https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=400&h=250&fit=crop",
                    "https://images.unsplash.com/photo-1593508512255-86ab42a8e620?w=400&h=250&fit=crop",
                ];

                $q = new WP_Query([
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'post_status' => 'publish',
                ]);

                $i = 0;

                if ($q->have_posts()):
                    while ($q->have_posts()): $q->the_post();

                        $img_url = $fallback_images[min($i, count($fallback_images) - 1)];
                        if (has_post_thumbnail()) {
                            $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
                            if ($thumb) $img_url = $thumb;
                        }
                ?>
                    <a class="blog-card" href="<?php the_permalink(); ?>" style="text-decoration:none;">
                        <div class="blog-image">
                            <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                        </div>
                        <div class="blog-content">
                            <h3 class="blog-title"><?php the_title(); ?></h3>
                            <p class="blog-description"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 20)); ?></p>
                        </div>
                    </a>
                <?php
                        $i++;
                    endwhile;
                    wp_reset_postdata();
                else:
                ?>
                    <div class="blog-card">
                        <div class="blog-image">
                            <img src="<?php echo esc_url($fallback_images[0]); ?>" alt="Blog">
                        </div>
                        <div class="blog-content">
                            <h3 class="blog-title">No posts yet</h3>
                            <p class="blog-description">Create your first WordPress blog post to show it here.</p>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <!-- Subscription Section -->
    <section id="subscribe" class="subscription-section">
        <div class="container">
            <div class="subscription-content">
                <div class="subscription-text">
                    <h2 class="subscription-title">Subscribe for Tech Insights</h2>
                </div>
                <div class="subscription-form-wrapper">
                    <form class="subscription-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                        <input type="hidden" name="action" value="demtech_subscribe">
                        <input type="hidden" name="demtech_nonce" value="<?php echo esc_attr(wp_create_nonce('demtech_subscribe')); ?>">

                        <div class="form-row">
                            <div class="form-group">
                                <input type="text" id="firstName" name="firstName" placeholder="First name*" required>
                            </div>
                            <div class="form-group">
                                <input type="text" id="lastName" name="lastName" placeholder="Last name*" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <input type="email" id="email" name="email" placeholder="Email address*" required>
                            </div>
                            <div class="form-group">
                                <input type="tel" id="phone" name="phone" placeholder="Phone number*" required>
                            </div>
                        </div>
                        <button type="submit" class="submit-button">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
