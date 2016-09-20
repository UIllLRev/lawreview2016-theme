<nav class="pagination">

  <?php

    $prev_link = get_previous_posts_link(__('Previous'));
    $next_link = get_next_posts_link(__('Next page'));

    if ( $prev_link || $next_link ) {

      if ( $prev_link ) {
        echo $prev_link;
      } else {
        echo '<a class="button is-disabled">Previous</a>';
      }

      if ( $next_link ) {
        echo $next_link;
      } else {
        echo '<a class="button is-disabled">Next page</a>';
      }

    }

  ?>

  <ul>
  	<?php lawreviewwp_pagination(); ?>
  </ul>
</nav>

