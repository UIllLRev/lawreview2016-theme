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
	<body <?php body_class(); ?>>

    <?php if ( ! is_page('First 100 Days') ): ?>
		<!-- header -->
		<header class="header has-transition" role="banner">
            <div class="container">
                <nav class="nav nav-primary" role="navigation">
                    <div class="nav-left">
                        <a class="nav-item logo" href="<?php echo home_url(); ?>">
                            <?php get_template_part('includes/logo.svg'); ?>
                        </a>
                        <?php lawreview_nav(); ?>
                    </div>
                    <div class="is-flex is-hidden-mobile">
                        <a target="_blank" id="open-popup" class="nav-item is-icon">
                            <span class="icon">
                                <i class="fa fa-envelope"></i>
                            </span>
                        </a>
                        <a href="https://twitter.com/UIllLRev" target="_blank" class="nav-item is-icon">
                            <span class="icon">
                                <i class="fa fa-twitter"></i>
                            </span>
                        </a>
                        <a href="https://www.facebook.com/IllinoisLawReview" target="_blank" class="nav-item is-icon">
                            <span class="icon">
                                <i class="fa fa-facebook"></i>
                            </span>
                        </a>
                        <a href="https://illinoislawreview.org/feed/" target="_blank" class="nav-item is-icon">
                            <span class="icon">
                                <i class="fa fa-rss"></i>
                            </span>
                        </a>
                    </div>
                    <span class="nav-toggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </nav>
            </div>
		</header>
		<!-- /header -->
    <?php endif; ?>
