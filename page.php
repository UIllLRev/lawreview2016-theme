<?php get_header(); ?>

<main class="main" role="main">

  <section class="hero is-primary">
    <div class="hero-body">
      <div class="container">
        <h1 class="title is-page-title"><?php the_title(); ?></h1>
      </div>
    </div>
  </section>

  <?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <!-- If page is split into sections, show `.nav-secondary` -->
    <?php if( have_rows('menu__items') ): ?>

      <nav class="nav nav-secondary has-shadow">
        <div class="container">
          <div class="nav-center">

            <?php 

              while( have_rows('menu__items') ): the_row();

                // Get the item type: Link or Section
                $menu_type = get_sub_field('menu__item-type');

                if ( $menu_type === 'link' ) {

                $label = get_sub_field('menu__link-label');
                $link = get_sub_field('menu__link-url');
                $target = '_blank';

                } elseif ( $menu_type === 'section' ) {

                $label = get_sub_field('menu__section-label');
                $link = '#' . str_replace(' ', '-', strtolower($label));
                $target = '_self';

                }

                echo "<a href=\"" . $link 
                . "\" class=\"nav-item is-tab\" target=\"" 
                . $target . "\">" . $label . "</a>";

              endwhile; 

            ?>

          </div>
        </div>
      </nav>

    <?php endif; ?>

    <section class="section">
      <div class="container">
        <div class="columns">
          <div class="column is-10 is-offset-1">						

            <article id="post-<?php the_ID(); ?>" class="post single">
              <div class="post-content content">

              	<div class="body">
                  <?php 

                    the_content();

                    if( have_rows('menu__items') ) {

                      while ( have_rows('menu__items') ): the_row();

                        // Check if the item type is Section before displaying
                        if ( get_sub_field('menu__item-type') === 'section' ) {

                        $title =  get_sub_field('menu__section-title');
                        $label = get_sub_field('menu__section-label');
                        $link = str_replace(' ', '-', strtolower($label));

                        echo "<h2><a name=\"" . $link . "\"></a>"
                        . $title . "</h2>";
                        echo "<div>" . get_sub_field('menu__section-content') . "</div>";

                      }

                      endwhile;

                    }

                  ?>
                </div>

                <?php edit_post_link(); ?>

              </div>
            </article>

          </div>
        </div>
      </div>
    </section>

    <?php endwhile; ?>

  <?php else: ?>

    <article>
      <h2 class="title is-2"><?php _e( 'Sorry, nothing to display.' ); ?></h2>
    </article>

  <?php endif; ?>

</main>

<?php get_footer(); ?>
