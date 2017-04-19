<?php /* Template Name: First 100 Days */ get_header(); ?>

	<main class="main">
		<!-- section -->
		<section class="section">
			<div class="container">
      	<div class="columns">
      		<div clas="column">

				<h1><?php the_title(); ?></h1>

				<?php
				    $args = array(
				      'post_type' => 'ilr_symposium',
				      'tax_query' => array(
				        array(
				          'taxonomy' => 'category',
				          'field' => 'slug',
				          'terms' => 'first-100-days'
				        )
				      )
				    );
				    $symposium = new WP_Query( $args );
				    if( $symposium->have_posts() ) {
				      while( $symposium->have_posts() ) {
				        $symposium->the_post();
				        ?>
				          <h2 class="title is-3"><?php the_title() ?></h2>
				          <div class="content">
				            <?php the_content() ?>
				          </div>
				        <?php
				      }
				    }
				    else {
				      echo 'Nothing found!';
				    }
				  ?>

					</div>
				</div>
			</div>
		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>
