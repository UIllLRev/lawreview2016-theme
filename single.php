<?php get_header(); ?>

<main class="main" role="main">
  <section class="section">
    <div class="container">
      <div class="columns">
        <div class="column is-10 is-offset-1">

          <?php if ( have_posts() ): ?> 

            <?php while ( have_posts() ) : the_post(); 

              $label = ucfirst( get_field('ilr_post_type') );
              $subtitle = get_field('ilr_subtitle');
              $author = get_field('ilr_author');
              $citation = get_field('ilr_citation');
              $pdf_link = get_field('ilr_pdf_link');

            ?>

              <article id="post-<?php the_ID(); ?>" class="post single">

                <!-- Post Header -->
                <header class="post-header">

                  <!-- label -->
                  <?php if ( !empty($label) ) : ?>
                    <span class="tag is-primary"><?=$label?></span>
                  <?php endif; ?>

                  <!-- title -->
                  <h1 class="title is-1"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>

                  <!-- subtitle -->
                  <?php if ( !empty($subtitle) ) : ?>
                    <h3 class="subtitle is-3"><?=$subtitle?></h3>
                  <?php endif; ?>

                  <!-- meta: author -->
                  <?php if ( !empty($author) ) : ?>
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
                    <?php if ( !empty($citation) ) : ?>
                      <span class="citation"><?=$citation?></span>
                    <?php endif; ?>

                    <!-- meta: pdf link -->
                    <?php if ( !empty($pdf_link) ) : ?>
                      <span class="pdf-link"><a href="<?=$pdf_link?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>Download</a></span>
                    <?php endif; ?>
                  </div>

                  <!-- body -->
                  <div class="body">

                    <?php 

                      if ( empty_content( $post->post_content ) && !empty_content( $post->post_excerpt ) ) {
                        
                        echo '<p>' . get_the_excerpt() . '</p>';
                      
                      } elseif ( !empty_content( $post->post_content ) ) {

                        the_content();
                      
                      }

                    ?>

                    <?php if ( !empty($pdf_link) ) : ?>

                      <p><em>The full text of this <?=$label?> is available to <a href="<?=$pdf_link?>">download as a PDF</a>.</em></p>

                    <?php endif; ?>

                    <p><?php edit_post_link(); ?></p>

                  </div>
                </div>
              </article>

            <?php endwhile; ?>

          <?php else: ?>

            <article>
              <h2 class="title"><?php _e('Sorry, nothing to display.'); ?></h2>
            </article>

          <?php endif; ?>

        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
