<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

    <link href="//www.google-analytics.com" rel="dns-prefetch">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/images/icons/favicon.ico" rel="shortcut icon">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/images/icons/touch.png" rel="apple-touch-icon-precomposed">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <?php wp_head(); ?>

</head>
<body id="f100d" <?php body_class( 'intro-transition' ); ?>>

    <header class="header">
        <div class="full-screen-background"></div>
        <div class="full-screen-menu">
            <div class="container is-fluid">
                <div class="columns">
                    <div class="column">
                        <div class="menu">
                            <p class="menu-label">First 100 Days</p>
                            <ul class="menu-list">

                            <?php lawreview_get_posts_by_category_id( 159, 2 ); ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="nav">
            <div class="nav-left">
                <a class="nav-item logo" href="<?php echo home_url(); ?>">
                    <?php get_template_part('includes/logo.svg'); ?>
                </a>
            </div>

            <div class="nav-right nav-menu">

            <?php if ( is_page('First 100 Days') ): ?>
                <a href="#f100d_introduction" class="nav-item is-active" id="menu-introduction">Introduction</a>
                <a href="#f100d_topics" class="nav-item" id="menu-topics">Topics</a>
                <a href="#f100d_contributors" class="nav-item" id="menu-contributors">Contributors</a>
            <?php else: ?>
                <span class="nav-item nav-toggle-label">Explore articles</span>
            <?php endif; ?>

                <span class="nav-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </div>
        </nav>
    </header>
