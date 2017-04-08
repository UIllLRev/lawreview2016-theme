<?php /* Template Name: Homepage Template */ get_header(); ?>

<main class="main" role="main">

<?php
  $post_types = lawreview_get_post_types();

  // set up arguments
  $posts = get_posts(array(
    'posts_per_page' => 1,
    'tax_query' => array(
      array(
        'taxonomy' => 'category',
        'field' => 'term_id',
        'terms' => 138, // 138 is the Featured id
      ),
    ),
  ));
?>

<?php if ( $posts ): ?>

  <section class="hero is-primary">
    <div class="hero-body">
      <div class="container">

        <?php foreach( $posts as $post ) : setup_postdata( $post );

          $label = $post_types[get_field('ilr_post_type')];
          $subtitle = get_field('ilr_subtitle');
          $author = get_field('ilr_author');
          $citation = get_field('ilr_citation');

        ?>

          <article class="post featured">

            <!-- label -->
            <?php if ( !empty($label) ) : ?>
              <span class="tag is-primary"><?=$label?></span>
            <?php endif; ?>

            <!-- title -->
            <h1 class="title is-1"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

            <!-- subtitle -->
            <?php if ( !empty($subtitle) ) : ?>
              <h2 class="subtitle is-3"><?=$subtitle?></h2>
            <?php endif; ?>

            <!-- meta -->
            <div class="post-meta">

              <!-- meta: author -->
              <?php if ( !empty($author) ) : ?>
                <span class="author">by <?=$author?></span>
              <?php endif; ?>

              <!-- meta: citation -->
              <?php if ( !empty($citation) ) : ?>
                <span class="citation"><?=$citation?></span>
              <?php endif; ?>
            </div>
          </article>

        <?php endforeach; ?>

      </div>
    </div>
  </section>

<?php endif;?>


  <section class="section">
    <div class="container">
      <div class="columns">

        <!-- COLUMN: Print posts -->
        <div class="column is-9-tablet is-8-desktop main-content">

          <?php
            $posts = get_posts( array(
              'posts_per_page' => 6,
              'orderby' => 'date',
              'order' => 'DESC',
              'tax_query' => array(
                array(
                  'taxonomy' => 'category',
                  'field' => 'term_id',
                  'terms' => 36
                  // 36 is the Print id
                  // 10 is the Online id
                  //'terms' => array( 36, 10 ),
                ),
              ),
            ));
          ?>

          <?php if( $posts ):

            foreach( $posts as $post ) : setup_postdata( $post );

              $label = $post_types[get_field('ilr_post_type')];
              $subtitle = get_field('ilr_subtitle');
              $author = get_field('ilr_author');
              $citation = get_field('ilr_citation');

              if ( $label != 'Note' ):

            ?>

              <article class="post">

                <!-- label -->
                <?php if ( !empty($label) ) : ?>
                  <span class="tag is-primary"><?=$label?></span>
                <?php endif; ?>

                <!-- title -->
                <h2 class="title is-3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                <!-- subtitle -->
                <?php if ( !empty($subtitle) ) : ?>
                  <h3 class="subtitle is-4"><?=$subtitle?></h3>
                <?php endif; ?>

                <!-- meta -->
                <div class="post-meta">

                  <!-- meta: author -->
                  <?php if ( !empty($author) ) : ?>
                    <span class="author">by <?=$author?></span>
                  <?php endif; ?>

                  <!-- meta: citation -->
                  <?php if ( !empty($citation) ) : ?>
                    <span class="citation"><?=$citation?></span>
                  <?php endif; ?>
                </div>
              </article>

            <?php endif; endforeach; ?>

          <?php else: ?>

            <article class="post">
              <h2 class="title is-3">Nothing to display</h2>
              <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
            </article>

          <?php endif; ?>

        </div>

        <!-- COLUMN: Online -->
        <div class="column is-3-tablet is-2-desktop sidebar online">

          <span class="label">Online</span>

          <?php
            $posts = get_posts( array(
              'posts_per_page' => 10,
              'orderby' => 'date',
              'order' => 'DESC',
              'tax_query' => array(
                array(
                  'taxonomy' => 'category',
                  'field' => 'term_id',
                  'terms' => 10, // 10 is the Online id
                ),
              ),
            ));
          ?>

          <?php if( $posts ):

            foreach( $posts as $post ) : setup_postdata( $post );
              $label = $post_types[get_field('ilr_post_type')];
              $subtitle = get_field('ilr_subtitle');
              // like strip_tags() only removes content too
              // we do this to remove star footnote
              $author = preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', get_field('ilr_author'));
              $citation = get_field('ilr_citation');

            ?>

              <article class="post">

                <!-- meta: date -->
                <div class="post-meta">
                  <span class="date"><time datetime="<?php the_time('Y-m-d'); ?>"><?php echo get_the_date(); ?></time></span>
                </div>

                <!-- title -->
                <h4 class="title is-6"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

                <!-- meta: author -->
                <?php if ( !empty($author) ) : ?>
                  <div class="post-meta">
                    <span class="author">by <?=$author?></span>
                  </div>
                <?php endif; ?>

              </article>

            <?php endforeach; ?>

          <?php else: ?>

            <article class="post">
              <h2 class="title is-3">Nothing to display</h2>
              <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
            </article>

          <?php endif; ?>

        </div>

        <!-- COLUMN: News, Popular -->
        <div class="column is-hidden-touch is-2-desktop sidebar news">

          <!-- News -->
          <span class="label">News</span>

          <?php
            $posts = get_posts( array(
              'posts_per_page' => 5,
              'orderby' => 'date',
              'order' => 'DESC',
              'tax_query' => array(
                array(
                  'taxonomy' => 'category',
                  'field' => 'term_id',
                  'terms' => 8, // 8 is the News id
                ),
              ),
            ));
          ?>

          <?php if( $posts ):

            foreach( $posts as $post ) : setup_postdata( $post );

            ?>

              <article class="post">

                <!-- meta: date -->
                <div class="post-meta">
                  <span class="date"><time datetime="<?php the_time('Y-m-d'); ?>"><?php echo get_the_date(); ?></time></span>
                </div>

                <!-- title -->
                <h4 class="title is-6"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
              </article>

            <?php endforeach; ?>

          <?php else: ?>

            <article class="post">
              <h2 class="title is-3">Nothing to display</h2>
              <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
            </article>

          <?php endif; ?>


          <!-- Popular Posts -->
          <span class="label">Popular</span>

          <?php
            $popular = new WP_Query( array(
              'posts_per_page' => 5,
              'meta_key' => 'popular_posts',
              'orderby' => 'meta_value_num',
              'order' => 'DESC',
              'tax_query' => array(
                array(
                  'taxonomy' => 'category',
                  'field' => 'term_id',
                  'terms' => array( 36, 10 ),
                ),
              ),
            ));
          ?>

          <?php while ($popular->have_posts()) : $popular->the_post(); ?>

            <article class="post">

              <!-- meta: date -->
              <div class="post-meta">
                <span class="date"><time datetime="<?php the_time('Y-m-d'); ?>"><?php echo get_the_date(); ?></time></span>
              </div>

              <!-- title -->
              <h4 class="title is-6"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            </article>

          <?php endwhile; wp_reset_postdata(); ?>

        </div>

      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>
