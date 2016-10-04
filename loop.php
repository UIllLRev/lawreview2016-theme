<?php

$post_types = lawreview_get_post_types();

if ( have_posts() ) : ?>

  <?php while ( have_posts() ) : the_post(); 

    $label = $post_types[get_field('ilr_post_type')];
    $subtitle = get_field('ilr_subtitle');
    $author = get_field('ilr_author');
    $citation = get_field('ilr_citation');

    ?>

    <article id="post-<?php the_ID(); ?>" class="post">

      <?php if ( !empty($label) ) : ?>
        <span class="tag is-primary"><?=$label?></span>
      <?php endif; ?>

      <h2 class="title is-3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

      <?php if ( !empty($subtitle) ) : ?>
        <h3 class="subtitle is-4"><?=$subtitle?></h3>
      <?php endif; ?>

      <?php if ( !empty($author) || !empty($citation) ) : ?>
        <div class="post-meta">
          <?php if ( !empty($author) ) : ?>
            <span class="author">by <?=$author?></span>
          <?php endif; ?>
          <?php if ( !empty($citation) ) : ?>
            <span class="citation"><?=$citation?></span>
          <?php endif; ?>
        </div>
        <?php endif; ?>
        
    </article>

  <?php endwhile; ?>

<?php else: ?>

  <article>
    <h2><?php _e( 'Sorry, nothing to display.', 'lawreview' ); ?></h2>
  </article>

<?php endif; ?>
