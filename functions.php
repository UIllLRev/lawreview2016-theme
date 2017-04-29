<?php

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load external files here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('lawreview', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// Law Review navigation
function lawreview_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => false,
		'menu_class'      => 'nav-menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
		'depth'           => 0,
		'walker'          => new nav_walker()
		)
	);
}

class nav_walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth, $args)
    {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $output .= $indent . '<li id="menu-item-'. $item->ID . '" class="nav-item">';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .' class="nav-item">';
        $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
        $item_output .= $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

        if ($item->menu_order == 1) {
            $classes[] = 'first';
        }

    }
}

// Popular Posts: Check and set hit count
function lawreview_popular_posts($post_id) {
    $count_key = 'popular_posts';
    $count = get_post_meta($post_id, $count_key, true);
    if ($count === '') {
        $count = 0;
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
    } else {
        $count++;
        update_post_meta($post_id, $count_key, $count);
    }
}

// Popular Posts: Hook into wp_head and call function on load
function lawreview_track_posts($post_id) {
    if (!is_single()) return;
    if (empty($post_id)) {
        global $post;
        $post_id = $post->ID;
    }
    lawreview_popular_posts($post_id);
}

// Load Law Review header scripts (header.php)
function lawreview_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_register_script('scroll-watcher', '//cdn.jsdelivr.net/scroll-watcher/latest/scroll-watcher.min.js', array('jquery'));
        wp_enqueue_script('scroll-watcher');

        wp_register_script('fontawesome', '//use.fontawesome.com/1acee197ed.js', array(), '4.7.0');
        wp_enqueue_script('fontawesome');

        wp_register_script('lawreviewscripts', get_template_directory_uri() . '/assets/js/scripts.min.js', array('jquery'), '1.0.0', true); // Custom scripts
        wp_enqueue_script('lawreviewscripts'); // Enqueue it!
    }
}

// Loading Conditional Scripts
function lawreview_conditional_scripts()
{

  wp_register_script('first-100-days-js', get_template_directory_uri() . '/first-100-days/js/first-100-days.js', array('jquery', 'scroll-watcher'), '1.0.0');

  if ( is_page( 'First 100 Days' ) || ( is_single() && in_category('First 100 Days') ) ) {
    wp_enqueue_script('first-100-days-js');
  }
}

// Load Law Review styles
function lawreview_styles()
{
    /**
     * Enqueue Google Fonts like this to avoid character encoding in the URL.
     * Source: http://wordpress.stackexchange.com/a/77264
     */
    $protocol = is_ssl() ? 'https' : 'http';
    $query_args = array(
      'family' => 'Alegreya:400,700,700i|Alegreya+Sans:300,300i,500,500i,700,800',
      'subset' => 'latin',
    );
    wp_enqueue_style('googlefonts',
      add_query_arg($query_args, "$protocol://fonts.googleapis.com/css" ), array(), null);

    wp_register_style('lawreview-styles', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('lawreview-styles'); // Enqueue it!
}

// Load Law Review conditional styles
function lawreview_conditional_styles()
{

  wp_register_style('first-100-days-css', get_template_directory_uri() . '/first-100-days/css/first-100-days.css', array('lawreview-styles'), '1.0');

  if ( is_page( 'First 100 Days' ) || ( is_single() && in_category('First 100 Days') ) ) {
    wp_enqueue_style('first-100-days-css');
  }
}

// Register Law Review Navigation
function register_lawreview_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'lawreview'), // Main Nav
        'sidebar-menu' => __('Sidebar Menu', 'lawreview'), // Sidebar Nav
        'extra-menu' => __('Extra Menu', 'lawreview') // Extra Nav
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Check if content is empty
function empty_content($var)
{
    return trim(str_replace('&nbsp;','',strip_tags($var))) === '';
}

// Remove Injected classes, ID's and Page ID's from Nav <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'lawreview'),
        'description' => __('Description for this widget-area...', 'lawreview'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'lawreview'),
        'description' => __('Description for this widget-area...', 'lawreview'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

/**
 * Custom function to replace WordPress default `paginate_links`
 * because this is the only way to completely control/replace the
 * styles given to the pagination links injected on the page.
 *
 * If this needs to be removed for any reason, be sure to change
 * the `lawreviewwp_pagination` function that is below this. Right
 * now, that function calls `pagination_links()` so replace that with
 * the default `paginate_links()` to restore original functionality.
 *
 */
function pagination_links( $args = '' ) {
  global $wp_query, $wp_rewrite;
  $pagenum_link = html_entity_decode( get_pagenum_link() );
  $url_parts    = explode( '?', $pagenum_link );
  $total   = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
  $current = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
  $pagenum_link = trailingslashit( $url_parts[0] ) . '%_%';
  $format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
  $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';
  $defaults = array(
    'base' => $pagenum_link,
    'format' => $format,
    'total' => $total,
    'current' => $current,
    'show_all' => false,
    'prev_next' => true,
    'prev_text' => __('&laquo; Previous'),
    'next_text' => __('Next &raquo;'),
    'end_size' => 1,
    'mid_size' => 2,
    'type' => 'plain',
    'add_args' => array(),
    'add_fragment' => '',
    'before_page_number' => '',
    'after_page_number' => ''
  );
  $args = wp_parse_args( $args, $defaults );
  if ( ! is_array( $args['add_args'] ) ) {
    $args['add_args'] = array();
  }

  if ( isset( $url_parts[1] ) ) {
    $format = explode( '?', str_replace( '%_%', $args['format'], $args['base'] ) );
    $format_query = isset( $format[1] ) ? $format[1] : '';
    wp_parse_str( $format_query, $format_args );
    wp_parse_str( $url_parts[1], $url_query_args );
    foreach ( $format_args as $format_arg => $format_arg_value ) {
      unset( $url_query_args[ $format_arg ] );
    }
    $args['add_args'] = array_merge( $args['add_args'], urlencode_deep( $url_query_args ) );
  }

  $total = (int) $args['total'];
  if ( $total < 2 ) {
    return;
  }
  $current  = (int) $args['current'];
  $end_size = (int) $args['end_size'];
  if ( $end_size < 1 ) {
    $end_size = 1;
  }
  $mid_size = (int) $args['mid_size'];
  if ( $mid_size < 0 ) {
    $mid_size = 2;
  }
  $add_args = $args['add_args'];
  $r = '';
  $page_links = array();
  $dots = false;
  if ( $args['prev_next'] && $current && 1 < $current ) :
    $link = str_replace( '%_%', 2 == $current ? '' : $args['format'], $args['base'] );
    $link = str_replace( '%#%', $current - 1, $link );
    if ( $add_args )
      $link = add_query_arg( $add_args, $link );
    $link .= $args['add_fragment'];

    $page_links[] = '<a class="pagination-previous" href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '">' . $args['prev_text'] . '</a>';
  endif;
  for ( $n = 1; $n <= $total; $n++ ) :
    if ( $n == $current ) :
      $page_links[] = "<a class='pagination-link  is-current'>" . $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number'] . "</a>";
      $dots = true;
    else :
      if ( $args['show_all'] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
        $link = str_replace( '%_%', 1 == $n ? '' : $args['format'], $args['base'] );
        $link = str_replace( '%#%', $n, $link );
        if ( $add_args )
          $link = add_query_arg( $add_args, $link );
        $link .= $args['add_fragment'];
        $page_links[] = "<a class='pagination-link' href='" . esc_url( apply_filters( 'paginate_links', $link ) ) . "'>" . $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number'] . "</a>";
        $dots = true;
      elseif ( $dots && ! $args['show_all'] ) :
        $page_links[] = '<a class="pagination-link" disabled>' . __( '&hellip;' ) . '</a>';
        $dots = false;
      endif;
    endif;
  endfor;
  if ( $args['prev_next'] && $current && ( $current < $total || -1 == $total ) ) :
    $link = str_replace( '%_%', $args['format'], $args['base'] );
    $link = str_replace( '%#%', $current + 1, $link );
    if ( $add_args )
      $link = add_query_arg( $add_args, $link );
    $link .= $args['add_fragment'];
    $page_links[] = '<a class="pagination-next" href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '">' . $args['next_text'] . '</a>';
  endif;
  switch ( $args['type'] ) {
    case 'array' :
      return $page_links;
    case 'list' :
      $r .= "<ul class='page-numbers'>\n\t<li>";
      $r .= join("</li>\n\t<li>", $page_links);
      $r .= "</li>\n</ul>\n";
      break;
    default :
      $r = join("\n", $page_links);
      break;
  }
  return $r;
}

// Custom pagination
function lawreviewwp_pagination()
{
    global $wp_query;
    $big = 999999999;
    $pages = pagination_links(array(
        'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'prev_next' => false,
        'type' => 'array',
    ));

    if ( is_array($pages) ) {
        $paged = ( get_query_var('paged') === 0 ) ? 1 : get_query_var('paged');
        foreach ( $pages as $page ) {
            echo '<li>' . $page . '</li>';
        }
    }
}

// Add class to prev pagination link
function posts_link_attributes_1() {
    return 'class="pagination-previous"';
}

// Add class to next pagination link
function posts_link_attributes_2() {
    return 'class="pagination-next"';
}

// Custom Excerpts
function lawreviewwp_index($length) // Create 20 Word Callback for Index page Excerpts, call using lawreviewwp_excerpt('lawreviewwp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using lawreviewwp_excerpt('lawreviewwp_custom_post');
function lawreviewwp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function lawreviewwp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function lawreview_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'lawreview') . '</a>';
}

function lawreview_no_featured_permalink($cat, $cats, $post)
{
    if ($cat->category_nicename == 'featured' && count($cats) > 1) {
        return $cats[1];
    }

    return $cat;
}

function lawreview_get_posts_by_category_id( $category_id, $offset = 0 )
{
    $args = array(
        'posts_per_page'  => 9999, // set a high number so `offset` works
        'offset'          => $offset,
        'category'        => $category_id,
        'orderby'         => 'menu_order',
        'order'           => 'ASC',
        'post_type'       => 'ilr_symposium',
        'post_status'     => 'publish',
    );

    $posts = new WP_Query( $args );

    while ( $posts->have_posts() ) : $posts->the_post();
        $title = get_the_title();
        $subtitle = get_field('ilr_subtitle');

        if ( ! empty($subtitle) ) {
            echo '<li><a href="' . get_the_permalink() . '">' . $title . ': ' . $subtitle . '</a></li>';
        } else {
            echo '<li><a href="' . get_the_permalink() . '">' . $title . '</a></li>';
        }
    endwhile;
}

function lawreview_get_post_types() {
    $field_name = 'ilr_post_type';
    foreach (get_posts(array('post_type' => 'acf', 'posts_per_page' => -1)) as $acf) {
        $meta = get_post_meta($acf->ID);
        foreach($meta as $key => $field) {
            if(substr($key, 0, 6) == 'field_') {
                $field = unserialize($field[0]);
                if($field['name'] == $field_name && isset($field['choices'])) {
                    return $field['choices'];
                }
            }
        }
    }
}

function lawreview_query_posts($type) {
    global $query_string;
    query_posts($query_string.'&meta_key=ilr_post_type&meta_value='.$type.'&posts_per_page=-1');
}

function lawreview_post_count() {
    global $wp_query;
    return $wp_query->post_count;
}

function lawreview_plural_suffix($stem) {
    // Not even trying to be comprehensive here
    if (substr($stem, -2) == 'ch' || substr($stem, -2) == 'sh')
        return 'es';
    return 's';
}

// The following two filters sort ILR post types by page number.
function lawreview_custom_posts_join_paged($join, $query) {
    if ($query->get('meta_key') == 'ilr_post_type') {
        $join .= " INNER JOIN (SELECT post_id, meta_value AS ilr_citation FROM wp_postmeta WHERE meta_key = 'ilr_citation') AS citations ON (citations.post_id = wp_posts.ID)";
    }
    return $join;
}

function lawreview_custom_posts_orderby($orderby_statement, $query) {
    if ($query->get('meta_key') == 'ilr_post_type') {
        $orderby_statement = "CAST(SUBSTRING_INDEX(TRIM(ilr_citation), ' ', -1) AS UNSIGNED)";
    }
    return $orderby_statement;
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function lawreview_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function lawreviewgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/assets/images/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function lawreviewcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

function lawreview_feed_rss2( $for_comments ) {
	$rss_template = get_template_directory() . '/feed-rss2.php';
	load_template($rss_template);
}

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'lawreview_header_scripts'); // Add Custom Scripts
add_action('wp_print_scripts', 'lawreview_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'lawreview_styles'); // Add Theme Stylesheet
add_action('wp_enqueue_scripts', 'lawreview_conditional_styles'); // Add Conditional Page Styles
add_action('init', 'register_lawreview_menu'); // Add Law Review Menu
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'lawreviewwp_pagination'); // Add custom Pagination
add_action('wp_head', 'lawreview_track_posts'); // Add Popular Post tracking

// Add Feeds
add_feed('rss2', 'lawreview_feed_rss2');

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('previous_posts_link_attributes', 'posts_link_attributes_1');
add_filter('next_posts_link_attributes', 'posts_link_attributes_2');
add_filter('avatar_defaults', 'lawreviewgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'lawreview_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
//add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'lawreview_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
add_filter('post_link_category', 'lawreview_no_featured_permalink', 10, 3); // Don't use featured category in permalinks
add_filter('posts_join_paged', 'lawreview_custom_posts_join_paged', 10, 2); // Sort by page number
add_filter('posts_orderby', 'lawreview_custom_posts_orderby', 10, 2); // Sort by page number

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt













/**
 * Custom Post Type: Article
 * ===========================
 *
 * Create a custom post type for law review article.
 * ------------------------------------------------------------------------- */

function lawreview_custom_post_article()
{

    // See `get_post_type_labels()` for label keys.
    $labels = array(
        'name'                  => _x( 'Articles', 'lawreview' ),
        'singular_name'         => _x( 'Article', 'lawreview' ),
        'menu_name'             => _x( 'Articles', 'lawreview' ),
        'name_admin_bar'        => _x( 'Article', 'lawreview' ),
        'add_new'               => __( 'Add New', 'lawreview' ),
        'add_new_item'          => __( 'Add New Article', 'lawreview' ),
        'new_item'              => __( 'New Article', 'lawreview' ),
        'edit_item'             => __( 'Edit Article', 'lawreview' ),
        'view_item'             => __( 'View Article', 'lawreview' ),
        'all_items'             => __( 'All Articles', 'lawreview' ),
        'search_items'          => __( 'Search Articles', 'lawreview' ),
        'parent_item_colon'     => __( 'Parent Article:', 'lawreview' ),
        'not_found'             => __( 'No articles found', 'lawreview' ),
        'not_found_in_trash'    => __( 'No articles found in Trash', 'lawreview' ),
        'featured_image'        => _x( 'Article Image', 'lawreview' ),
        'set_featured_image'    => _x( 'Set article image', 'lawreview' ),
        'remove_featured_image' => _x( 'Remove article image', 'lawreview' ),
        'use_featured_image'    => _x( 'Use as article image', 'lawreview' ),
        'archives'              => _x( 'Articles archives', 'lawreview' ),
        'insert_into_item'      => _x( 'Insert into article', 'lawreview' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this article', 'lawreview' ),
        'filter_items_list'     => _x( 'Filter articles list', 'lawreview' ),
        'items_list_navigation' => _x( 'Articles list navigation', 'lawreview' ),
        'items_list'            => _x( 'Articles list', 'lawreview' ),
    );

    // See `register_post_type()` for args parameters.
    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'hierarchical'          => false,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_in_admin_bar'     => true,
        'menu_position'         => 2,
        'menu_icon'             => 'dashicons-book-alt',
        'capability_type'       => 'post',
        'supports'              => array(
                                        'title',
                                        'editor',
                                        'thumbnail',
                                        'revisions',
                                    ),
        'taxonomies'            => array( 'category' ),
        'has_archive'           => true,
        'rewrite'               => array( 'slug' => 'article' ),
        'query_var'             => true,
        'can_export'            => true,
    );

    register_post_type( 'ilr_article', $args );
}
add_action( 'init', 'lawreview_custom_post_article');




/**
 * Custom Post Type: Note
 * ======================
 *
 * Create a custom post type for law review note.
 * ------------------------------------------------------------------------- */

function lawreview_custom_post_note()
{

    // See `get_post_type_labels()` for label keys.
    $labels = array(
        'name'                  => _x( 'Notes', 'lawreview' ),
        'singular_name'         => _x( 'Note', 'lawreview' ),
        'menu_name'             => _x( 'Notes', 'lawreview' ),
        'name_admin_bar'        => _x( 'Note', 'lawreview' ),
        'add_new'               => __( 'Add New', 'lawreview' ),
        'add_new_item'          => __( 'Add New Note', 'lawreview' ),
        'new_item'              => __( 'New Note', 'lawreview' ),
        'edit_item'             => __( 'Edit Note', 'lawreview' ),
        'view_item'             => __( 'View Note', 'lawreview' ),
        'all_items'             => __( 'All Notes', 'lawreview' ),
        'search_items'          => __( 'Search Notes', 'lawreview' ),
        'parent_item_colon'     => __( 'Parent Note:', 'lawreview' ),
        'not_found'             => __( 'No notes found', 'lawreview' ),
        'not_found_in_trash'    => __( 'No notes found in Trash', 'lawreview' ),
        'featured_image'        => _x( 'Note Image', 'lawreview' ),
        'set_featured_image'    => _x( 'Set note image', 'lawreview' ),
        'remove_featured_image' => _x( 'Remove note image', 'lawreview' ),
        'use_featured_image'    => _x( 'Use as note image', 'lawreview' ),
        'archives'              => _x( 'Notes archives', 'lawreview' ),
        'insert_into_item'      => _x( 'Insert into note', 'lawreview' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this note', 'lawreview' ),
        'filter_items_list'     => _x( 'Filter notes list', 'lawreview' ),
        'items_list_navigation' => _x( 'Notes list navigation', 'lawreview' ),
        'items_list'            => _x( 'Notes list', 'lawreview' ),
    );

    // See `register_post_type()` for args parameters.
    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'hierarchical'          => false,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_in_admin_bar'     => true,
        'menu_position'         => 3,
        'menu_icon'             => 'dashicons-book-alt',
        'capability_type'       => 'post',
        'supports'              => array(
                                        'title',
                                        'editor',
                                        'thumbnail',
                                        'revisions',
                                    ),
        'taxonomies'            => array( 'category' ),
        'has_archive'           => true,
        'rewrite'               => array( 'slug' => 'note' ),
        'query_var'             => true,
        'can_export'            => true,
    );

    register_post_type( 'ilr_note', $args );
}
add_action( 'init', 'lawreview_custom_post_note');




/**
 * Add Excerpt to Custom Posts
 * ===========================
 */

function lawreview_add_excerpt_to_cpt()
{
  add_post_type_support( 'ilr_symposium', 'excerpt' );
}
add_action( 'init', 'lawreview_add_excerpt_to_cpt' );




/**
 * Custom Post Type: Symposium
 * ===========================
 *
 * Create a custom post type for law review symposiums.
 * ------------------------------------------------------------------------- */

function lawreview_custom_post_symposium()
{

    // See `get_post_type_labels()` for label keys.
    $labels = array(
        'name'                  => _x( 'Symposiums', 'lawreview' ),
        'singular_name'         => _x( 'Symposium', 'lawreview' ),
        'menu_name'             => _x( 'Symposiums', 'lawreview' ),
        'name_admin_bar'        => _x( 'Symposium', 'lawreview' ),
        'add_new'               => __( 'Add New', 'lawreview' ),
        'add_new_item'          => __( 'Add New Symposium', 'lawreview' ),
        'new_item'              => __( 'New Symposium', 'lawreview' ),
        'edit_item'             => __( 'Edit Symposium', 'lawreview' ),
        'view_item'             => __( 'View Symposium', 'lawreview' ),
        'all_items'             => __( 'All Symposiums', 'lawreview' ),
        'search_items'          => __( 'Search Symposiums', 'lawreview' ),
        'parent_item_colon'     => __( 'Parent Symposium:', 'lawreview' ),
        'not_found'             => __( 'No symposiums found', 'lawreview' ),
        'not_found_in_trash'    => __( 'No symposiums found in Trash', 'lawreview' ),
        'featured_image'        => _x( 'Symposium Image', 'lawreview' ),
        'set_featured_image'    => _x( 'Set Symposium image', 'lawreview' ),
        'remove_featured_image' => _x( 'Remove symposium image', 'lawreview' ),
        'use_featured_image'    => _x( 'Use as symposium image', 'lawreview' ),
        'archives'              => _x( 'Symposiums archives', 'lawreview' ),
        'insert_into_item'      => _x( 'Insert into symposium', 'lawreview' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this symposium', 'lawreview' ),
        'filter_items_list'     => _x( 'Filter symposiums list', 'lawreview' ),
        'items_list_navigation' => _x( 'Symposiums list navigation', 'lawreview' ),
        'items_list'            => _x( 'Symposiums list', 'lawreview' ),
    );

    // See `register_post_type()` for args parameters.
    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'hierarchical'          => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_in_admin_bar'     => true,
        'menu_position'         => 4,
        'menu_icon'             => 'dashicons-book-alt',
        'capability_type'       => 'post',
        'supports'              => array(
                                        'title',
                                        'editor',
                                        'page-attributes',
                                        'thumbnail',
                                        'revisions',
                                    ),
        'taxonomies'            => array( 'category' ),
        'has_archive'           => true,
        'rewrite'               => array( 'slug' => 'symposium' ),
        'query_var'             => true,
        'can_export'            => true,
    );

    register_post_type( 'ilr_symposium', $args );
}
add_action( 'init', 'lawreview_custom_post_symposium');




/**
 * Remove items from dashboard
 * ===========================
 *
 * Certain admin menu items are unnecessary, so we remove them.
 * ------------------------------------------------------------------------- */

function lawreview_remove_menus()
{
  $user = wp_get_current_user();

  if ( ! in_array( 'administrator', $user->roles ) ) {
    remove_menu_page( 'index.php' );
    remove_menu_page( 'plugins.php' );
    remove_submenu_page( 'themes.php', 'themes.php' );
    remove_menu_page( 'tools.php' );
  }

  remove_menu_page( 'edit-comments.php' );
  remove_menu_page( 'link-manager.php' );
}
add_action( 'admin_menu', 'lawreview_remove_menus' );




/**
 * Reorder dashboard menu items
 * ============================
 *
 * Move
 * ------------------------------------------------------------------------- */

function lawreview_reorder_menus( $menu_order )
{
  return array(
    'index.php',
    'edit.php?post_type=ilr_article',
    'edit.php?post_type=ilr_note',
    'edit.php?post_type=ilr_symposium',
    'separator1',
    'edit.php',
    'edit.php?post_type=page',
    'upload.php',
  );
}
add_filter( 'custom_menu_order', '__return_true' );
add_filter( 'menu_order', 'lawreview_reorder_menus' );




/**
 * First 100 Days single post template
 * ===================================
 *
 * Assign posts with the "First 100 Days" category to a custom template.
 * ----------------------------------------------------------------------------
 */

add_filter( 'single_template', function($single_template) {

  global $post;

  if ( in_category('First 100 Days') ) {
    $single_template = dirname( __FILE__ ) . '/first-100-days/single.php';
  }

  // if ( in_category('News') ) {
  //   $single_template = dirname( __FILE__ ) . '/single-news.php';
  // }
  return $single_template;

}, 10, 3);




/**
 * Add Open Graph
 * ==============
 */

function lawreview_add_opengraph()
{
    if ( is_single() ) {
        global $post;

        if ( get_the_post_thumbnail($post->ID, 'thumbnail') ) {
            $thumbnail_id = get_post_thumbnail_id($post->ID);
            $thumbnail_object = get_post($thumbnail_id);
            $image = $thumbnail_object->guid;
        } else {
            // set default image please
            $image = '';
        }

        $description = substr(strip_tags($post->post_content),0,200) . '...';

        echo '<meta property="og:title" content="' . the_title() . '" />';
        echo '<meta property="og:type" content="article" />';
        echo '<meta property="og:image" content="' . $image . '" />';
        echo '<meta property="og:url" content="' . the_permalink() . '" />';
        echo '<meta property="og:description" content="' . $description . '" />';
        echo '<meta property="og:site_name" content="Illinois Law Review" />';
    }
}
add_action('wp_head', 'lawreview_add_opengraph');


?>
