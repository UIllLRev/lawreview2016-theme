<?php
/**
 * Template Name: First 100 Days
 */

get_template_part( 'first-100-days/header' );

global $post;

if ( $post->post_parent == 0 ):

    // the id of the parent post in the symposium collection
    $symposium_id = get_the_ID();

    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'ilr_symposium',
        'post_parent' => $symposium_id,
        'orderby' => 'menu_order',
        'order' => 'ASC',
    );

    $posts = new WP_Query( $args );

    if ( $posts->have_posts() ): ?>

        <main class="main">

            <!-- INTRODUCTION -->
            <section id="f100d_introduction" class="section">
                <article class="container is-fluid">
                    <div class="columns  section__inner">
                        <?php

                            while ( $posts->have_posts() ) :
                            $posts->the_post();

                            $intro_title = get_field('f100d_title_intro');

                            // only output post 0
                            if ( $posts->current_post < 1 ): ?>

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
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                </article>

                <?php
                    while ( $posts->have_posts() ) :
                    $posts->the_post();

                    $ilr_collection_block = get_field('ilr_collection_block');
                    $ilr_collection_blocksub = get_field('ilr_collection_blocksub');
                    $ilr_collection_blocklink = get_field('ilr_collection_blocklink');

                    if ( ! empty($ilr_collection_block) ) : ?>
                        <blockquote class="section__quote">
                        <p class="section__quote__text"><?=$ilr_collection_block?></p>

                        <footer class="section__quote__footer">
                        <?php if (! empty($ilr_collection_blocklink) && ! empty($ilr_collection_blocksub)) : ?>

                          <a href="<?=$ilr_collection_blocklink?>" target="_blank"><?=$ilr_collection_blocksub?></a>

                        <?php elseif (empty($ilr_collection_blocklink) && ! empty($ilr_collection_blocksub)) : ?>

                          <a><?=$ilr_collection_blocksub?></a>

                        <?php else: ?>

                        <?php endif; ?>
                        </footer>
                        </blockquote>
                    <?php endif; ?>
                <?php endwhile; ?>
            </section>

            <!-- TOPICS -->
            <section id="f100d_topics" name="f100d_topics" class="section  content-is-hidden">
                <div class="container">
                    <div class="columns  section__inner">
                        <div class="column is-8  section__content">
                            <h2 class="section__title">Topics of discussion</h2>
                            <ol class="topics__list">

                                <?php

                                // rewind loop to beginning
                                $posts->rewind_posts();
                                while ( $posts->have_posts() ) :
                                    $posts->the_post();

                                    $topic_title = get_field('f100d_title_topics');

                                    // only output post 1 and above
                                    if ( $posts->current_post >= 1 ): ?>

                                        <li class="topics__list__item">
                                            <a href="<?php the_permalink(); ?>">

                                                <?php

                                                    if ( ! empty($topic_title) ) {
                                                        echo $topic_title;
                                                    } else {
                                                        the_title();
                                                    }
                                                ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </ol>
                        </div>

                        <?php if ( is_page(4962) ) : ?>
                            <figure class="column is-4  section__figure">
                                <div class="section__figure__inner  has-transition">
                                    <img class="section__figure__image" src="/wp-content/uploads/2017/04/trump-02.jpg" alt="">
                                </div>
                            </figure>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

            <!-- CONTRIBUTORS -->
            <section id="f100d_contributors" class="section  content-is-hidden">
                <div class="container">
                  <div class="columns  section__inner">
                      <div class="column is-12  section__content">
                        <h2 class="section__title">Featured speakers</h2>
                        <?php while ( have_posts() ) : the_post();

                            $author = preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', get_field('ilr_author'));
                            $ilr_collection_faimage = get_field('ilr_collection_faimage');
                            $ilr_collection_fatitle = get_field('ilr_collection_fatitle');
                            ?>

                            <div class="columns  contributors__speakers">
                                <a href="<?php echo get_permalink(); ?>" class="column is-half-tablet is-one-third-desktop is-one-quarter-widescreen">
                                    <img src="<?=$ilr_collection_faimage?>">
                                    <div class="contributors__person">
                                        <div class="contributors__name"><?=$author?></div>
                                        <div class="contributors__title"><?=$ilr_collection_fatitle?></div>
                                    </div>
                                </a>
                            </div> <!-- closes div for .contributors__speakers-->
                        <?php endwhile; ?>
                      </div> <!-- closes div for .section__content-->
                  </div> <!-- closes div for .columns-->
                </div> <!-- closes div for .container-->
           </section>
        </main>
    <?php endif; ?>
<?php else : ?>

    <main class="main" role="main">
      <section class="section">
        <div class="container">
          <div class="columns">
            <div class="column is-10 is-offset-1">

              <?php
              // Start the loop
              while ( have_posts() ) : the_post();

                $label = $post_types[get_field('ilr_post_type')];
                $subtitle = get_field('ilr_subtitle');
                $author = get_field('ilr_author');
                $citation = get_field('ilr_citation');
                $pdf_link = get_field('ilr_pdf_link'); ?>

                <article id="post-<?php the_ID(); ?>" class="post single">

                  <!-- Post Header -->
                  <header class="post-header">

                    <!-- label -->
                    <span class="tag is-primary">
                      <a href="/first-100-days">First 100 Days</a>
                    </span>

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

              <?php
              endwhile; // End of the loop
              ?>

            </div>
          </div>
        </div>
      </section>
      <section id="f100d_introduction" style="display:none;"></section>
      <section id="f100d_topics" style="display:none;"></section>
      <section id="f100d_contributors" style="display:none;"></section>
    </main>

<?php endif; ?>

<?php get_footer(); ?>
