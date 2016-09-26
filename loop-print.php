<?php 
  global $query_string;
  query_posts($query_string . '&meta_key=ilr_post_type&meta_value=symposium&posts_per_page=-1&orderby=date&order=ASC');
  if ( have_posts() ): ?>

  <!-- SECTION: Symposium -->
  <span class="label is-primary">Symposium</span>
  <ul class="group">

    <?php while ( have_posts() ) : the_post();

      $label = ucfirst( get_field('ilr_post_type') );
      $title = get_the_title();
      $subtitle = get_field('ilr_subtitle');
      $author = get_field('ilr_author');

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

    <?php endwhile; ?>

  </ul>

<?php
  endif;
  query_posts($query_string . '&meta_key=ilr_post_type&meta_value=article&posts_per_page=-1&orderby=date&order=ASC');
  if ( have_posts() ): ?>

  <!-- SECTION: Articles -->
  <span class="label is-primary">Article<?php if (lawreview_post_count() > 1) echo 's'; ?></span>
  <ul class="group">

    <?php while ( have_posts() ) : the_post();

      $label = ucfirst( get_field('ilr_post_type') );
      $title = get_the_title();
      $subtitle = get_field('ilr_subtitle');
      $author = get_field('ilr_author');

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

    <?php endwhile; ?>

  </ul>

<?php
  endif;
  query_posts($query_string . '&meta_key=ilr_post_type&meta_value=lecture&posts_per_page=-1&orderby=date&order=ASC');
  if ( have_posts() ): ?>

  <!-- SECTION: David C. Baum Memorial Lecture -->
  <span class="label is-primary">David C. Baum Memorial Lecture<?php if (lawreview_post_count() > 1) echo 's'; ?></span>
  <ul class="group">

    <?php while ( have_posts() ) : the_post();

      $label = ucfirst( get_field('ilr_post_type') );
      $title = get_the_title();
      $subtitle = get_field('ilr_subtitle');
      $author = get_field('ilr_author');

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

    <?php endwhile; ?>

  </ul>

<?php
  endif;
  query_posts($query_string . '&meta_key=ilr_post_type&meta_value=essay&posts_per_page=-1&orderby=date&order=ASC');
  if ( have_posts() ): ?>

  <!-- SECTION: Book Review Essays -->
  <span class="label is-primary">Book Review Essay<?php if (lawreview_post_count() > 1) echo 's'; ?></span>
  <ul class="group">

    <?php while ( have_posts() ) : the_post();

      $label = ucfirst( get_field('ilr_post_type') );
      $title = get_the_title();
      $subtitle = get_field('ilr_subtitle');
      $author = get_field('ilr_author');

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

    <?php endwhile; ?>

  </ul>

<?php
  endif;
  query_posts($query_string . '&meta_key=ilr_post_type&meta_value=note&posts_per_page=-1&orderby=date&order=ASC');
  if ( have_posts() ): ?>

  <!-- SECTION: Notes -->
  <span class="label is-primary">Note<?php if (lawreview_post_count() > 1) echo 's'; ?></span>
  <ul class="group">

    <?php while ( have_posts() ) : the_post();

      $label = ucfirst( get_field('ilr_post_type') );
      $title = get_the_title();
      $subtitle = get_field('ilr_subtitle');
      $author = get_field('ilr_author');

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

    <?php endwhile; ?>

  </ul>

<?php endif; ?>
