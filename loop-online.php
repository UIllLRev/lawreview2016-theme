<?php

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

query_posts( array(
  'post_type' => 'post',
  'posts_per_page' => 10,
  'paged' => $paged,
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

if ( have_posts() ) : ?>

  <?php while ( have_posts() ) : the_post(); 

    $label = get_field('ilr_post_type');
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

<?php else : ?>

  <article class="post">
    <h2 class="title is-3">Nothing to display</h2>
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
  </article>

<?php endif; ?>

