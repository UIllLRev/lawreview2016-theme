<?php /* Template Name: First 100 Days */ get_header(); ?>

	<main class="main">
		<!-- section -->
		<section class="section">
			<div class="container">
      	<div class="columns">
      		<div clas="column">

						<h1><?php the_title(); ?></h1>

					<?php if (have_posts()): while (have_posts()) : the_post(); ?>

						<!-- article -->
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<?php the_content(); ?>

							<?php // comments_template( '', true ); ?>

							<br class="clear">

							<?php edit_post_link(); ?>

						</article>
						<!-- /article -->

					<?php endwhile; ?>

					<?php else: ?>

						<!-- article -->
						<article>

							<h2><?php _e( 'Sorry, nothing to display.', 'lawreview' ); ?></h2>

						</article>
						<!-- /article -->

					<?php endif; ?>

					</div>
				</div>
			</div>
		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>
