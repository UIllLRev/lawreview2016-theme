<?php get_header(); ?>

	<main role="main">

    <!-- banner -->
    <section class="hero is-primary">
      <div class="hero-body">
        <div class="container">

          <h1 class="title is-page-title">
            <?php
              $postType = get_queried_object();
              echo esc_html($postType->labels->name); ?>
          </h1>
        </div>
      </div>
    </section>

    <!-- inner navigation -->
    <?php if ( $postType->labels->name === 'Symposiums'): ?>
        <nav class="nav nav-secondary has-shadow">
            <div class="container">
              <div class="nav-center">

                <a href="#symposiums" class="nav-item is-tab">Symposiums</a><a href="#response" class="nav-item is-tab">Responses</a>

              </div>
            </div>
        </nav>
    <?php endif; ?>

    <!-- events -->
    <section class="section">
      <div class="container">
        <div class="columns">
          <div class="column is-10 is-offset-1 main-content">

            <?php get_template_part('loop', 'collections'); ?>
            <?php get_template_part('pagination'); ?>

          </div>
        </div>
      </div>
    </section>


	</main>

<?php get_footer(); ?>
