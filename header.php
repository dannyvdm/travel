<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<!--[if lt IE 9]>
<script src="https://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title><?php wp_title(''); ?></title>
<link rel="profile" href="https://gmpg.org/xfn/11" />

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php /*
<link href="<?php the_field('favicon', 'options'); ?>" rel="shortcut icon" type="image/x-icon" />
<link href="<?php the_field('favicon', 'options'); ?>" rel="icon" type="image/ico" />
*/ ?>

<link href="<?php bloginfo('template_url'); ?>/apple-icon.png" rel="apple-touch-icon-precomposed" sizes="144x144" />
<link href="<?php bloginfo('template_url'); ?>/apple-icon.png" rel="apple-touch-icon" />

<?php
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>

</head>

<body <?php body_class(); ?>>

<header id="mainheader">
	<div class="container">
		<div id="logo" class="content-100 center">
			<a href="<?php echo home_url( '/' ); ?>" title="Reistips Dresden">
				<img src="<?php bloginfo('template_url'); ?>/images/reizen-en-reistips-logo.png" />
				<h2>Dresden</h2>
			</a>
		</div>
	</div>
</header>