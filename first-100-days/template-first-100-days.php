<?php
/**
 * Template Name: First 100 Days
 */

get_template_part( 'first-100-days/header' );

// the id of the parent post in the symposium collection
$symposium_id = 4869;

$args = array(
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
        <article class="container">
            <div class="columns  section__inner">

            <?php

                while ( $posts->have_posts() ) :
                $posts->the_post();

                // only output post 0
                if ( $posts->current_post < 1 ): ?>

                    <figure class="column is-5  section__figure">
                        <div class="section__figure__inner  has-transition">
                            <?php the_post_thumbnail('post-thumbnail', ['class' => 'section__figure__image']); ?>
                            <!-- <img class="section__figure__image" src="http://placehold.it/1100x1395"> -->
                        </div>
                    </figure>
                    <div class="column is-8  section__content is-large">
                        <h2 class="section__title is-large"><?php the_title(); ?></h2>
                        <div class="section__text"><?php the_content() ?></div>
                    </div>

                <?php endif; ?>
            <?php endwhile; ?>

            </div>
        </article>
        <blockquote class="section__quote">
            <p class="section__quote__text">"Lorem ipsum dolor sit amet, consectetuer adipiscing elit sed diam nonummy nibh euismod tincidunt ut laoreet dolore."</p>
            <footer class="section__quote__footer">Lorem ipsum dolor</footer>
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

                        // only output post 1 and above
                        if ( $posts->current_post >= 1 ): ?>

                            <li class="topics__list__item">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </li>

                        <?php endif; ?>

                    <?php endwhile; ?>

                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>
                            <li class="topics__list__item"><a href="#">Name TBD</a></li>

                    </ol>
                </div>
                <figure class="column is-4  section__figure">
                    <div class="section__figure__inner  has-transition">
                        <img class="section__figure__image" src="/wp-content/uploads/2017/04/trump-02.jpg" alt="">
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
                      <a href="#" class="column is-half-tablet is-one-third-desktop is-one-quarter-widescreen">
                        <img src="<?php echo get_template_directory_uri(); ?>/first-100-days/images/akhil-amar.jpg">
                        <div class="contributors__person">
                            <div class="contributors__name">Akhil Reed Amar</div>
                            <div class="contributors__title">Sterling Professor of Law and Political Science at Yale University</div>
                        </div>
                      </a>
                      <a href="#" class="column is-half-tablet is-one-third-desktop is-one-quarter-widescreen">
                        <img src="<?php echo get_template_directory_uri(); ?>/first-100-days/images/jeffrey-brown.jpg">
                        <div class="contributors__person">
                            <div class="contributors__name">Jeffrey R. Brown</div>
                            <div class="contributors__title">Dean, College of Business at University of Illinois</div>
                        </div>
                      </a>
                      <a href="#" class="column is-half-tablet is-one-third-desktop is-one-quarter-widescreen">
                        <img src="<?php echo get_template_directory_uri(); ?>/first-100-days/images/andreas-cangellaris.jpg">
                        <div class="contributors__person">
                            <div class="contributors__name">Andreas C. Cangellaris</div>
                            <div class="contributors__title">Dean, College of Engineering at University of Illinois</div>
                        </div>
                      </a>
                      <a href="#" class="column is-half-tablet is-one-third-desktop is-one-quarter-widescreen">
                        <img src="<?php echo get_template_directory_uri(); ?>/first-100-days/images/adam-chilton.jpg">
                        <div class="contributors__person">
                            <div class="contributors__name">Adam Chilton</div>
                            <div class="contributors__title">Assistant Professor of Law at University of Chicago</div>
                        </div>
                      </a>
                      <a href="#" class="column is-half-tablet is-one-third-desktop is-one-quarter-widescreen">
                        <img src="<?php echo get_template_directory_uri(); ?>/first-100-days/images/kathleen-clark.jpg">
                        <div class="contributors__person">
                            <div class="contributors__name">Kathleen Clark</div>
                            <div class="contributors__title">Professor of Law at Washington University</div>
                        </div>
                      </a>
                      <a href="#" class="column is-half-tablet is-one-third-desktop is-one-quarter-widescreen">
                        <img src="<?php echo get_template_directory_uri(); ?>/first-100-days/images/erin-delaney.jpg">
                        <div class="contributors__person">
                            <div class="contributors__name">Erin F. Delaney</div>
                            <div class="contributors__title">Associate Professor of Law at Northwestern University</div>
                        </div>
                      </a>
                      <a href="#" class="column is-half-tablet is-one-third-desktop is-one-quarter-widescreen">
                        <img src="<?php echo get_template_directory_uri(); ?>/first-100-days/images/jason-mazzone.jpg">
                        <div class="contributors__person">
                            <div class="contributors__name">Jason Mazzone</div>
                            <div class="contributors__title">Professor of Law at University of Illinois</div>
                        </div>
                      </a>
                      <a href="#" class="column is-half-tablet is-one-third-desktop is-one-quarter-widescreen">
                        <img src="<?php echo get_template_directory_uri(); ?>/first-100-days/images/neil-richards.jpg">
                        <div class="contributors__person">
                            <div class="contributors__name">Neil Richards</div>
                            <div class="contributors__title">Thomas and Karole Green Professor of Law at Washington University</div>
                        </div>
                      </a>
                    </div>

                    <h2 class="section__title">Symposium authors</h2>
                    <div class="columns  contributors__authors">
                        <a href="#" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Vik Amar</div>
                                <div class="contributors__title">Dean, College of Law at University of Illinois</div>
                            </div>
                        </a>
                        <a href="#" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Dale Carpenter</div>
                                <div class="contributors__title">Title Title Title Title at Organization Organization</div>
                            </div>
                        </a>
                        <a href="#" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Verity Winship</div>
                                <div class="contributors__title">Title Title Title Title at Organization Organization</div>
                            </div>
                        </a>
                        <a href="#" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Arden Rowell</div>
                                <div class="contributors__title">Title Title Title Title at Organization Organization</div>
                            </div>
                        </a>
                        <a href="#" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Stephen Rushin</div>
                                <div class="contributors__title">Title Title Title Title at Organization Organization</div>
                            </div>
                        </a>
                        <a href="#" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Heidi Kitrosser</div>
                                <div class="contributors__title">Title Title Title Title at Organization Organization</div>
                            </div>
                        </a>
                        <a href="#" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Jonathan Hafetz</div>
                                <div class="contributors__title">Title Title Title Title at Organization Organization</div>
                            </div>
                        </a>
                        <a href="#" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Robert Mikos</div>
                                <div class="contributors__title">Title Title Title Title at Organization Organization</div>
                            </div>
                        </a>
                        <a href="#" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Michael Helfand</div>
                                <div class="contributors__title">Title Title Title Title at Organization Organization</div>
                            </div>
                        </a>
                        <a href="#" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Richard Kaplan</div>
                                <div class="contributors__title">Title Title Title Title at Organization Organization</div>
                            </div>
                        </a>
                        <a href="#" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Robin Wilson</div>
                                <div class="contributors__title">Title Title Title Title at Organization Organization</div>
                            </div>
                        </a>
                        <a href="#" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Robert Williams</div>
                                <div class="contributors__title">Title Title Title Title at Organization Organization</div>
                            </div>
                        </a>
                        <a href="#" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Derek Muller</div>
                                <div class="contributors__title">Title Title Title Title at Organization Organization</div>
                            </div>
                        </a>
                        <a href="#" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Lindsey Lusk</div>
                                <div class="contributors__title">Title Title Title Title at Organization Organization</div>
                            </div>
                        </a>
                        <a href="#" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Bradley Williams</div>
                                <div class="contributors__title">Title Title Title Title at Organization Organization</div>
                            </div>
                        </a>
                        <a href="#" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Leslie Wexler</div>
                                <div class="contributors__title">Title Title Title Title at Organization Organization</div>
                            </div>
                        </a>
                        <a href="#" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">RonNell Andersen Jones</div>
                                <div class="contributors__title">Title Title Title Title at Organization Organization</div>
                            </div>
                        </a>
                        <a href="#" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Lisa Grow Sun</div>
                                <div class="contributors__title">Title Title Title Title at Organization Organization</div>
                            </div>
                        </a>
                        <a href="#" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Margareth Etienne</div>
                                <div class="contributors__title">Title Title Title Title at Organization Organization</div>
                            </div>
                        </a>
                        <a href="#" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Eric T. Freyfogle</div>
                                <div class="contributors__title">Title Title Title Title at Organization Organization</div>
                            </div>
                        </a>
                        <a href="#" class="column is-half-tablet is-one-third-desktop">
                            <div class="contributors__person">
                                <div class="contributors__name">Robin Kar</div>
                                <div class="contributors__title">Title Title Title Title at Organization Organization</div>
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
