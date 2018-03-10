<?php get_header(); ?>

  <main class="main">
    <section class="hero is-primary">
      <div class="hero-body">
        <div class="container">
          <?php
            $post_type = get_queried_object();
            echo '<h1 class="title is-page-title">' . esc_html($post_type->labels->name) . '</h1>';
          ?>
        </div>
      </div>
    </section>
    <section class="section">
      <div class="container">
        <div class="columns">
          <?php
            echo '<div class="column is-10 is-offset-1 main-content">';
                    get_template_part('loop');
                    get_template_part('pagination');
            echo '</div>';
          ?>
        </div>
      </div>
    </section>
  </main>

<?php get_footer(); ?>
