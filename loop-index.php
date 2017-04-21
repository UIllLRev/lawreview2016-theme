<?php 
$cats = get_terms(
    array(
        'taxonomy' => 'category',
        'orderby' => 'name',
        'order' => 'DESC',
        'hide_empty' => true,
        'parent' => 36
    ));
$previous_year = '';
foreach ($cats as $child_cat) {
    $child_cat_link = get_term_link($child_cat);
    if (preg_match('/(\d{4})/', $child_cat->slug, $matches)) {
        if ($matches[1] !== $previous_year) {
            if (!empty($previous_year)) {
                echo '</ul></li></ul>';
            }
            echo '<ul class="collapse"><li class="collapse"><input type="checkbox" class="collapse" id="year-'.$matches[1].'"/>';
            echo '<label class="collapse" for="year-'.$matches[1].'">'.$matches[1].'</label><ul class="collapse">';
            $previous_year = $matches[1];
        }
        echo '<li class="collapse"><a href="'.$child_cat_link.'">'.$child_cat->name.'</a></li>';
    }
}
if (!empty($previous_year)) {
    echo '</ul></li></ul>';
}
?>
