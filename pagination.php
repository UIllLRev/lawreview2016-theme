<nav class="pagination is-centered">

  <?php

    $prev_link = get_previous_posts_link(__('Previous'));
    $next_link = get_next_posts_link(__('Next page'));

    if ( $prev_link || $next_link ) {

      if ( $prev_link ) {
        echo $prev_link;
      } else {
        echo '<a class="pagination-previous" disabled>Previous</a>';
      }

      if ( $next_link ) {
        echo $next_link;
      } else {
        echo '<a class="pagination-next" disabled>Next page</a>';
      }

    }

  ?>

  <ul class="pagination-list">
  	<?php lawreviewwp_pagination(); ?>
  </ul>
</nav>

