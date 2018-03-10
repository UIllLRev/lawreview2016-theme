<?php

/**
 * Template Name: Collection
 * Template Post Type: post, ilr_article, ilr_note, ilr_symposium
 */

get_template_part( 'header' );

$post_type = get_post_type();

$args = array(
  'post_type' => $post_type,
  'posts_per_page' => -1,
  'post_parent' => $post->ID,
  'orderby' => 'menu_order',
  'order' => 'ASC',
);

$loop = new WP_Query( $args ); ?>

<main class="main">

  <!-- DEBUG -->
  <h2 class="title is-4" style="margin: 3rem 0">
    Post Type: <?=$post_type?>
  </h2>
  <!-- ##### -->

  <?php if ( $loop->have_posts() ) : ?>

    <!-- INTRODUCTION -->
    <section class="section">
      <article class="container is-fluid">
        <div class="columns  section__inner">
          <?php
            while ( $loop->have_posts() ) : $loop->the_post();

              $intro_title = get_field('f100d_title_intro'); ?>

              <figure class="column is-5  section__figure">
                <div class="section__figure__inner  has-transition">
                  <?php the_post_thumbnail('post-thumbnail', ['class' => 'section__figure__image']); ?>
                </div>
              </figure>
              <div class="column is-8  section__content is-large">
                <h2 class="section__title is-large">
                  <?php
                    if ( ! empty($intro_title) ) {
                      echo $intro_title;
                    } else {
                      the_title();
                    }
                  ?>
                </h2>
                <div class="section__text"><?php echo get_the_excerpt(); ?></div>
              </div>
            <?php endwhile; ?>
        </div>
      </article>
      <blockquote class="section__quote">
        <p class="section__quote__text">Lorem ipsum dolor sit amet</p>
        <footer class="section__quote__footer">
          <a href="#">Lorem ipsum</a>
        </footer>
      </blockquote>
    </section>

    <!-- TOPICS -->
    <section class="section content-is-hidden">
      <div class="container">
        <div class="columns  section__inner">
          <div class="column is-8. section__content">
            <h2 class="section__title">Topics of discussion</h2>
            <ol class="topics__list">
              <?php
              // rewind loop to beginning
              $loop->rewind_posts();
              while ( $loop->have_posts() ) : $loop->the_post();
                $topic_title = get_field('f100d_title_topics'); ?>

                <li class="topics__list__item">
                  <a href="<? the_permalink(); ?>" class="">
                    <?php
                      if ( ! empty($topic_title) ) {
                        echo $topic_title;
                      } else {
                        the_title();
                      }
                    ?>
                  </a>
                </li>
              <?php endwhile; ?>
            </ol>
          </div>
          <figure class="column is-4 section__figure">
            <div class="section__figure__inner  has-transition">
              <img class="section__figure__image" src="<?php echo site_url( '/wp-content/uploads/2017/04/trump-02.jpg/' ) ?>" alt="">
            </div>
          </figure>
        </div>
      </div>
    </section>

    <?php //while ( $loop->have_posts() ) : $loop->the_post(); ?>
        <p><?php //the_title(); ?></p>
    <?php //endwhile; ?>

  <?php else : ?>

    <?php while ( have_posts() ) : the_post();

      $get_post_types = lawreview_get_post_types();
      $label = $get_post_types[get_field('ilr_post_type')];
      $subtitle = get_field('ilr_subtitle');
      $author = get_field('ilr_author');
      $citation = get_field('ilr_citation');
      $pdf_link = get_field('ilr_pdf_link'); ?>

      <section class="section">
        <div class="container">
          <div class="columns">
            <div class="column is-10 is-offset-1">
              <article id="post-<?php the_ID(); ?>" class="post single">

                <!-- Post Header -->
                <header class="post-header">

                  <!-- label -->
                  <?php if ( ! empty($label) ) : ?>
                    <span class="tag is-primary"><?=$label?></span>
                  <?php endif; ?>

                  <!-- title -->
                  <h1 class="title is-1"><?php the_title(); ?></h1>

                  <!-- subtitle -->
                  <?php if ( ! empty($subtitle) ) : ?>
                    <h3 class="subtitle is-3"><?=$subtitle?></h3>
                  <?php endif; ?>

                  <!-- meta: author -->
                  <?php if ( ! empty($author) ) : ?>
                    <div class="post-meta">
                      <span class="author">by <?=$author?></span>
                    </div>
                  <?php endif; ?>
                </header>

                <!-- Post Content -->
                <div class="post-content content">

                  <!-- meta -->
                  <div class="post-meta">

                    <!-- meta: date -->
                    <span class="date"><time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('M j, Y'); ?></time></span>

                    <!-- meta: citation -->
                    <?php if ( ! empty($citation) ) : ?>
                      <span class="citation"><?=$citation?></span>
                    <?php endif; ?>

                    <!-- meta: pdf link -->
                    <?php if ( ! empty($pdf_link) ) : ?>
                      <span class="pdf-link"><a href="<?=$pdf_link?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>Download</a></span>
                    <?php endif; ?>
                  </div>

                  <!-- body -->
                  <div class="body">

                    <?php

                      if ( empty_content( $post->post_content ) && ! empty_content( $post->post_excerpt ) ) {

                        echo '<p>' . get_the_excerpt() . '</p>';

                      } elseif ( ! empty_content( $post->post_content ) ) {

                        the_content();

                      }

                    ?>

                    <?php if ( ! empty($pdf_link) ) : ?>

                      <p><em>The full text of this <?=$label?> is available to <a href="<?=$pdf_link?>">download as a PDF</a>.</em></p>

                    <?php endif; ?>

                    <p><?php edit_post_link(); ?></p>
                  </div>
                </div>
              </article>
            </div>
          </div>
        </div>
      </section>
    <?php endwhile; ?>
  <?php endif; ?>
</main>

<?php get_footer(); ?>
