<?php get_header(); ?>

  <main class="main" role="main">
    <section class="hero is-primary">
      <div class="hero-body">
        <div class="container">

          <h1 class="title is-page-title"><?php printf( __( '%s', 'lawreview2016' ), single_cat_title( '', false ) ); ?></h1>

        </div>
      </div>
    </section>
    <section class="section">
      <div class="container">
        <div class="columns">
          <div class="column is-10 is-offset-1 main-content">
            <?php get_template_part('loop'); ?>
            <?php get_template_part('pagination'); ?>
          </div>
        </div>
      </div>
    </section>

  </main>

<?php get_footer(); ?>
