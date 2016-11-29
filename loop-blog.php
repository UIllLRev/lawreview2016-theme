<?php

$post_types = lawreview_get_post_types();

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
      'terms' => 153, // 153 is the Blog id
    ),
  ),
));

if ( have_posts() ) : ?>

  <?php while ( have_posts() ) : the_post(); 

    $subtitle = get_field('ilr_subtitle');
    // like strip_tags() only removes content too
    // we do this to remove star footnote
    $author = preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', get_field('ilr_author'));

    ?>

    <article id="post-<?php the_ID(); ?>" class="post">

      <h2 class="title is-3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

      <?php if ( !empty($subtitle) ) : ?>
        <h3 class="subtitle is-4"><?=$subtitle?></h3>
      <?php endif; ?>

        <div class="post-meta">
          <?php if ( !empty($author) ) : ?>
            <span class="author">by <?=$author?></span>
          <?php endif; ?>
          <span class="date"><?php the_date(); ?></span>
        </div>

        <div class="post-excerpt">
            <?php the_excerpt(); ?>
        </div>

    </article>

  <?php endwhile; ?>

<?php else : ?>

  <article class="post">
    <h2 class="title is-3">Nothing to display</h2>
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
  </article>

<?php endif; ?>

