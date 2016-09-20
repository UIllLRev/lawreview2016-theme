<?php if ( have_posts() ): ?>

  <!-- SECTION: Articles -->
  <span class="label is-primary">Articles</span>
  <ul class="group">

    <?php while ( have_posts() ) : the_post();

      $label = ucfirst( get_field('ilr_post_type') );
      $title = get_the_title();
      $subtitle = get_field('ilr_subtitle');
      $author = get_field('ilr_author');

      if ( $label === 'Article' ):

      ?>

        <li class="item<?php if ( !empty($author) ): ?> has-author<?php endif; ?>">

          <h2 class="title"><a href="<?php the_permalink(); ?>"><?=$title?>&nbsp;</a></h2>
          <!-- leave the non-breaking space; it's a hack -->

          <?php if ( !empty($author) ) : ?>
            <span class="post-meta">
              <span class="author"><?=$author?></span>
            </span>
          <?php endif; ?>

        </li>

      <?php endif; ?>

    <?php endwhile; ?>

  </ul>

  <?php rewind_posts(); ?>

  <!-- SECTION: Notes -->
  <span class="label is-primary">Notes</span>
  <ul class="group">

    <?php while ( have_posts() ) : the_post();

      $label = ucfirst( get_field('ilr_post_type') );
      $title = get_the_title();
      $subtitle = get_field('ilr_subtitle');
      $author = get_field('ilr_author');

      if ( $label === 'Note' ):

      ?>

        <li class="item<?php if ( !empty($author) ): ?> has-author<?php endif; ?>">

          <h2 class="title"><a href="<?php the_permalink(); ?>"><?=$title?>&nbsp;</a></h2>
          <!-- leave the non-breaking space; it's a hack -->

          <?php if ( !empty($author) ) : ?>
            <span class="post-meta">
              <span class="author"><?=$author?></span>
            </span>
          <?php endif; ?>

        </li>

      <?php endif; ?>

    <?php endwhile; ?>

  </ul>

<?php endif; ?>









