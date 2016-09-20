<?php get_header(); ?>

<main class="main" role="main">
  <section class="hero is-primary">
    <div class="hero-body">
      <div class="container">
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="columns">
        <div class="column is-10 is-offset-1">
        	<article id="post-404" class="post">
        		<h1 class="title is-1">File not found</h1>
        		<h2 class="subtitle is-3">Sorry, but that page does not exist.</h2>
        		<p><a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'lawreview' ); ?></a></p>
        	</article>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
