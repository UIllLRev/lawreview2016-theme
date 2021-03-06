<?php get_header(); ?>

  <main class="main" role="main">
    <section class="hero is-primary">
      <div class="hero-body">
        <div class="container">

          <?php 

            $category_id = get_query_var('cat');
            $category = get_category($category_id);
            $category_parent_id = $category->category_parent;
            $title = single_cat_title("", false); 

            if ( $category_parent_id === 36 ) {
              // 36 is the category id of `Print Archives`
              echo '<h1 class="title is-page-title is-normal-case">' . $title . '</h1>';

            } elseif ( $category_parent_id === 10 ) {
              // 10 is the category id of `Law Review Online`
              echo '<h1 class="title is-page-title">Law Review Online</h1>';

            } else {
              echo '<h1 class="title is-page-title">' . $title . '</h1>';
            }

          ?>

        </div>
      </div>
    </section>
    <?php if ( $category_id === 10 || $category_id === 153): ?>
    <nav class="nav nav-secondary has-shadow">
        <div class="container">
          <div class="nav-center">

            <a href="/online/" class="nav-item is-tab">Articles</a><a href="/online-rankings/" class="nav-item is-tab">Rankings</a><a href="/blog/" class="nav-item is-tab">Blog</a>
          </div>
        </div>
    </nav>
    <?php endif; ?>
    <?php if ( $category_id === 175 || $category_parent_id === 175): ?>  
    <nav class="nav nav-secondary has-shadow">
        <div class="container">
          <div class="nav-center">
            <?php 
            $my_menu = array (
                'menu' => 'Response Piece Subnav',
                'walker' => new Class_Name_Walker,
                 'container'       => false,
                 'items_wrap'      => '%3$s',
                 'depth'           => 0,
                );
            wp_nav_menu($my_menu); ?>
          </div>
        </div>
    </nav>
    <?php endif; ?>
    <?php if ( $category_id >= 176 && $category_id <= 179): ?> 
    <section class="section" style="padding-bottom: 0";>
      <div class="container">
        <div class="columns">
        <div class="column is-10 is-offset-1">
        <p><?php echo category_description($category_id); ?></p>
        </div>
        </div>
      </div>
    </section>
    <?php endif; ?>

    <section class="section">
      <div class="container">
        <div class="columns">

          <?php

            if ( $category_id === 36 ) {

              echo '<div class="column is-10 is-offset-1 table-of-contents">';
                      get_template_part('loop', 'index');
              echo '</div>';

            } elseif ( $category_id === 10 ) {

              echo '<div class="column is-10 is-offset-1 main-content">';
                      get_template_part('loop', 'online');
                      get_template_part('pagination');
              echo '</div>';

            } elseif ( $category_id === 153 ) {

              echo '<div class="column is-10 is-offset-1 main-content">';
                      get_template_part('loop', 'blog');
                      get_template_part('pagination');
              echo '</div>';

            } elseif ( $category_parent_id === 36 ) {

              echo '<div class="column is-10 is-offset-1 table-of-contents">';
                      get_template_part('loop', 'print');
              echo '</div>';

            } elseif ( $category_id >= 176 && $category_id <= 179) {
                      echo '<div class="column is-10 is-offset-1 main-content">';
                      get_template_part('loop');
                      get_template_part('pagination');
              echo '</div>';

            } else {

              echo '<div class="column is-10 is-offset-1 main-content">';
                      get_template_part('loop');
                      get_template_part('pagination');
              echo '</div>';

            }

          ?>

          <?php //get_template_part('pagination'); ?>

        </div>
      </div>
    </section>

  </main>

<?php get_footer(); ?>
