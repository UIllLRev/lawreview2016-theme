<?php
/**
 * Template Name: First 100 Days Biden
 */

get_template_part( 'first-100-days-biden/header' );

// the id of the parent post in the symposium collection
$symposium_id = 7367;

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
        <blockquote class="section__quote">
            <p class="section__quote__text">[Biden quote here]"</p>
            <footer class="section__quote__footer">Joe Biden - date</footer>
        </blockquote>
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
                <figure class="column is-4  section__figure">
                    <div class="section__figure__inner  has-transition">
                        <img class="section__figure__image" src="/wp-content/uploads/2021/03/Official-Biden.jpg" alt="">
                    </div>
                </figure>
            </div>
        </div>
    </section>


    <!-- CONTRIBUTORS -->
    <section id="f100d_contributors" class="section  content-is-hidden">
        <div class="container">
            <div class="columns  section__inner">
                <div class="column is-12  section__content">
                    <h2 class="section__title">Featured speakers</h2>
                    <div class="columns  contributors__speakers">
                      <a href="<?php echo get_permalink( 4955 ); ?>" class="column is-half-tablet is-one-third-desktop is-one-quarter-widescreen">
                        <img src="<?php echo get_template_directory_uri(); ?>/first-100-days-biden/images/akhil-amar.jpg">
                        <div class="contributors__person">
                            <div class="contributors__name">Akhil Reed Amar</div>
                            <div class="contributors__title">Sterling Professor of Law and Political Science at Yale University</div>
                        </div>
                      </a>
                      <a href="<?php echo get_permalink( 4891 ); ?>" class="column is-half-tablet is-one-third-desktop is-one-quarter-widescreen">
                        <img src="<?php echo get_template_directory_uri(); ?>/first-100-days-biden/images/jeffrey-brown.jpg">
                        <div class="contributors__person">
                            <div class="contributors__name">Jeffrey R. Brown</div>
                            <div class="contributors__title">Dean, College of Business at the University of Illinois</div>
                        </div>
                      </a>
                      <a href="<?php echo get_permalink( 4959 ); ?>" class="column is-half-tablet is-one-third-desktop is-one-quarter-widescreen">
                        <img src="<?php echo get_template_directory_uri(); ?>/first-100-days-biden/images/andreas-cangellaris.jpg">
                        <div class="contributors__person">
                            <div class="contributors__name">Andreas C. Cangellaris</div>
                            <div class="contributors__title">Dean, College of Engineering at the University of Illinois</div>
                        </div>
                      </a>
                      <a href="<?php echo get_permalink( 5039 ); ?>" class="column is-half-tablet is-one-third-desktop is-one-quarter-widescreen">
                        <img src="<?php echo get_template_directory_uri(); ?>/first-100-days-biden/images/adam-chilton.jpg">
                        <div class="contributors__person">
                            <div class="contributors__name">Adam Chilton</div>
                            <div class="contributors__title">Assistant Professor of Law at University of Chicago</div>
                        </div>
                      </a>
                      <a href="<?php echo get_permalink( 5041 ); ?>" class="column is-half-tablet is-one-third-desktop is-one-quarter-widescreen">
                        <img src="<?php echo get_template_directory_uri(); ?>/first-100-days-biden/images/kathleen-clark.jpg">
                        <div class="contributors__person">
                            <div class="contributors__name">Kathleen Clark</div>
                            <div class="contributors__title">Professor of Law at Washington University</div>
                        </div>
                      </a>
                      <a href="<?php echo get_permalink( 5044 ); ?>" class="column is-half-tablet is-one-third-desktop is-one-quarter-widescreen">
                        <img src="<?php echo get_template_directory_uri(); ?>/first-100-days-biden/images/erin-delaney.jpg">
                        <div class="contributors__person">
                            <div class="contributors__name">Erin F. Delaney</div>
                            <div class="contributors__title">Associate Professor of Law at Northwestern University</div>
                        </div>
                      </a>
                      <a href="<?php echo get_permalink( 4883 ); ?>" class="column is-half-tablet is-one-third-desktop is-one-quarter-widescreen">
                        <img src="<?php echo get_template_directory_uri(); ?>/first-100-days-biden/images/jason-mazzone.jpg">
                        <div class="contributors__person">
                            <div class="contributors__name">Jason Mazzone</div>
                            <div class="contributors__title">Professor of Law at the University of Illinois</div>
                        </div>
                      </a>
                      <a href="<?php echo get_permalink( 4898 ); ?>" class="column is-half-tablet is-one-third-desktop is-one-quarter-widescreen">
                        <img src="<?php echo get_template_directory_uri(); ?>/first-100-days-biden/images/neil-richards.jpg">
                        <div class="contributors__person">
                            <div class="contributors__name">Neil Richards</div>
                            <div class="contributors__title">Thomas and Karole Green Professor of Law at Washington University</div>
                        </div>
                      </a>
                    </div>

                    <h2 class="section__title">Symposium authors</h2>
                    <div class="columns  contributors__authors">
                        <a href="<?php echo get_permalink( 4931 ); ?>" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Vikram David Amar</div>
                                <div class="contributors__title">Dean, College of Law at the University of Illinois</div>
                            </div>
                        </a>
                        <a href="<?php echo get_permalink( 4961 ); ?>" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Verity Winship</div>
                                <div class="contributors__title">Professor of law at the University of Illinois</div>
                            </div>
                        </a>
                        <a href="<?php echo get_permalink( 4937 ); ?>" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Arden Rowell</div>
                                <div class="contributors__title">Professor of law at the University of Illinois</div>
                            </div>
                        </a>
                        <a href="<?php echo get_permalink( 4894 ); ?>" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Stephen Rushin</div>
                                <div class="contributors__title">Assistant professor of law at the University of Alabama</div>
                            </div>
                        </a>
                        <a href="<?php echo get_permalink( 4969 ); ?>" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Heidi Kitrosser</div>
                                <div class="contributors__title">Professor of law at University of Minnesota Law School</div>
                            </div>
                        </a>
                        <a href="<?php echo get_permalink( 4973 ); ?>" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Jonathan Hafetz</div>
                                <div class="contributors__title">Professor of law at Seton Hall</div>
                            </div>
                        </a>
                        <a href="<?php echo get_permalink( 4978 ); ?>" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Robert Mikos</div>
                                <div class="contributors__title">Professor of law at Vanderbilt University</div>
                            </div>
                        </a>
                        <a href="<?php echo get_permalink( 4904 ); ?>" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Michael Helfand</div>
                                <div class="contributors__title">Associate professor of law at Pepperdine University School of Law</div>
                            </div>
                        </a>
                        <a href="<?php echo get_permalink( 4870 ); ?>" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Richard Kaplan</div>
                                <div class="contributors__title">Professor of law at the University of Illinois</div>
                            </div>
                        </a>
                        <a href="<?php echo get_permalink( 5053 ); ?>" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Robin Fretwell Wilson</div>
                                <div class="contributors__title">Professor of law at the University of Illinois</div>
                            </div>
                        </a>
                        <a href="<?php echo get_permalink( 5053 ); ?>" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Ryan Graver</div>
                                <div class="contributors__title">President of MedAxiom Ventures</div>
                            </div>
                        </a>
                        <a href="<?php echo get_permalink( 5053 ); ?>" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Larry Sobal</div>
                                <div class="contributors__title">Executive Vice President of Business Development for MedAxiom Ventures</div>
                            </div>
                        </a>
                        <a href="<?php echo get_permalink( 4990 ); ?>" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Robert Williams</div>
                                <div class="contributors__title">Executive director of the Paul Tsai China Center</div>
                            </div>
                        </a>
                        <a href="<?php echo get_permalink( 4879 ); ?>" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Derek Muller</div>
                                <div class="contributors__title">Associate professor of law at Pepperdine University</div>
                            </div>
                        </a>
                        <a href="<?php echo get_permalink( 5007 ); ?>" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Lindsey Ruta Lusk</div>
                                <div class="contributors__title">University of Illinois College of Law</div>
                            </div>
                        </a>
                        <a href="<?php echo get_permalink( 4889 ); ?>" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Bradley Williams</div>
                                <div class="contributors__title">University of Illinois College of Law</div>
                            </div>
                        </a>
                        <a href="<?php echo get_permalink( 4906 ); ?>" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Leslie Wexler</div>
                                <div class="contributors__title">Professor of law at the University of Illinois</div>
                            </div>
                        </a>
                        <a href="<?php echo get_permalink( 5049 ); ?>" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">RonNell Andersen Jones</div>
                                <div class="contributors__title">Professor of law at the University of Utah</div>
                            </div>
                        </a>
                        <a href="<?php echo get_permalink( 5049 ); ?>" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Lisa Grow Sun</div>
                                <div class="contributors__title">Associate professor of law at Brigham Young University</div>
                            </div>
                        </a>
                        <a href="<?php echo get_permalink( 4929 ); ?>" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Margareth Etienne</div>
                                <div class="contributors__title">Associate Dean for Graduate and International Programs at the University of Illinois College of Law</div>
                            </div>
                        </a>
                        <a href="<?php echo get_permalink( 5046 ); ?>" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Eric T. Freyfogle</div>
                                <div class="contributors__title">Professor of law at the University of Illinois</div>
                            </div>
                        </a>
                        <a href="<?php echo get_permalink( 5015 ); ?>" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Robin Bradley Kar</div>
                                <div class="contributors__title">Professor of law at the University of Illinois</div>
                            </div>
                        </a>
                        <a href="<?php echo get_permalink( 5151 ); ?>" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Daniel J. Hemel</div>
                                <div class="contributors__title">Assistant professor of law at University of Chicago</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

<?php endif; ?>
