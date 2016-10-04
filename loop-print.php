<?php 
  $post_types = lawreview_get_post_types();
  foreach (lawreview_get_post_types() as $post_type => $label):
    lawreview_query_posts($post_type);
    if ( have_posts() ):
        if ($label != 'Symposium' && lawreview_post_count() > 1) $label .= lawreview_plural_suffix($label);
        ?>

      <span class="label is-primary"><?php echo $label; ?></span>
          <ul class="group">

            <?php while ( have_posts() ) : the_post();

              $title = get_the_title();
              $subtitle = get_field('ilr_subtitle');
              $author = get_field('ilr_author');

              ?>

                <li class="item<?php if ( !empty($author) ): ?> has-author<?php endif; ?>">

                <h2 class="title"><a href="<?php the_permalink(); ?>"><?=$title?><?php if (!empty($subtitle)) echo ': '. $subtitle; ?>&nbsp;</a></h2>
                  <!-- leave the non-breaking space; it's a hack -->

                  <?php if ( !empty($author) ) : ?>
                    <span class="post-meta">
                      <span class="author"><?=$author?></span>
                    </span>
                  <?php endif; ?>

                </li>

            <?php endwhile; ?>

          </ul>

        <?php
          endif;
      endforeach;
?>
