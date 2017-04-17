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

    	wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
        wp_enqueue_script('conditionizr'); // Enqueue it!

        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!

        wp_register_script('lawreviewscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0', true); // Custom scripts
        wp_enqueue_script('lawreviewscripts'); // Enqueue it!

        wp_register_script('fontawesome', 'https://use.fontawesome.com/1acee197ed.js', array(), '4.6.3');
        wp_enqueue_script('fontawesome');
    }
}

// Load Law Review conditional scripts
function lawreview_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!
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


    wp_register_style('lawreview', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('lawreview'); // Enqueue it!
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

    $page_links[] = '<a class="button" href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '">' . $args['prev_text'] . '</a>';
  endif;
  for ( $n = 1; $n <= $total; $n++ ) :
    if ( $n == $current ) :
      $page_links[] = "<a class='button is-primary'>" . $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number'] . "</a>";
      $dots = true;
    else :
      if ( $args['show_all'] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
        $link = str_replace( '%_%', 1 == $n ? '' : $args['format'], $args['base'] );
        $link = str_replace( '%#%', $n, $link );
        if ( $add_args )
          $link = add_query_arg( $add_args, $link );
        $link .= $args['add_fragment'];
        $page_links[] = "<a class='button' href='" . esc_url( apply_filters( 'paginate_links', $link ) ) . "'>" . $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number'] . "</a>";
        $dots = true;
      elseif ( $dots && ! $args['show_all'] ) :
        $page_links[] = '<a class="button is-disabled">' . __( '&hellip;' ) . '</a>';
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
    $page_links[] = '<a class="button" href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '">' . $args['next_text'] . '</a>';
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
        //echo '<ul>';
        foreach ( $pages as $page ) {
            echo '<li>' . $page . '</li>';
        }
        //echo '</ul>';
    }
}

// Add class to pagination links
function posts_link_attributes() {
    return 'class="button"';
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
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
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
add_action('init', 'lawreview_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'lawreview_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'lawreview_styles'); // Add Theme Stylesheet
add_action('init', 'register_lawreview_menu'); // Add Law Review Menu
//add_action('init', 'create_post_type_lawreview'); // Add our Law Review Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'lawreviewwp_pagination'); // Add custom Pagination
add_action('wp_head', 'lawreview_track_posts'); // Add Popular Post tracking

// Add feeds
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
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');
add_filter('avatar_defaults', 'lawreviewgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
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

// Shortcodes
add_shortcode('lawreview_shortcode_demo', 'lawreview_shortcode_demo'); // You can place [lawreview_shortcode_demo] in Pages, Posts now.
add_shortcode('lawreview_shortcode_demo_2', 'lawreview_shortcode_demo_2'); // Place [lawreview_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [lawreview_shortcode_demo] [lawreview_shortcode_demo_2] Here's the page title! [/lawreview_shortcode_demo_2] [/lawreview_shortcode_demo]

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo
function create_post_type_lawreview()
{
    register_taxonomy_for_object_type('category', 'lawreview'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'lawreview');
    register_post_type('lawreview', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Law Review Custom Post', 'lawreview'), // Rename these to suit
            'singular_name' => __('Law Review Custom Post', 'lawreview'),
            'add_new' => __('Add New', 'lawreview'),
            'add_new_item' => __('Add New Law Review Custom Post', 'lawreview'),
            'edit' => __('Edit', 'lawreview'),
            'edit_item' => __('Edit Law Review Custom Post', 'lawreview'),
            'new_item' => __('New Law Review Custom Post', 'lawreview'),
            'view' => __('View Law Review Custom Post', 'lawreview'),
            'view_item' => __('View Law Review Custom Post', 'lawreview'),
            'search_items' => __('Search Law Review Custom Post', 'lawreview'),
            'not_found' => __('No Law Review Custom Posts found', 'lawreview'),
            'not_found_in_trash' => __('No Law Review Custom Posts found in Trash', 'lawreview')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom Law Review post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function lawreview_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function lawreview_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}

?>
