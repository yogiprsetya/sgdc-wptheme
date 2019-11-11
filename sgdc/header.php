<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sgdc
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="main-menu">
	<section class="container">
		<a class="brand" href="/">SGDC
			<!-- <img src="http://nunforest.com/mite-demo/images/logo.png" alt="logo sgdc"> -->
		</a>

		<a href="javascript:void(0);" class="burger-icon" onclick="humbMenu()">
			<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="30" height="30" viewBox="0 0 512 512"><path d="M491.3 235.3H20.7a20.7 20.7 0 1 0 0 41.4h470.6a20.7 20.7 0 1 0 0-41.4zM491.3 78.4H20.7a20.7 20.7 0 0 0 0 41.4h470.6a20.7 20.7 0 1 0 0-41.4zM491.3 392.2H20.7a20.7 20.7 0 1 0 0 41.4h470.6a20.7 20.7 0 1 0 0-41.4z"/></svg>
		</a>

		<nav id="myTopnav" class="topnav">
			<a href="" class="active">SUKA JALAN</a>
			<a href="">SUKA JAJAN</a>
			<a href="">LIFESTYLE</a>
			<a href="">INSPIRASI</a>
			<a href="">SAY HI!</a>
		</nav>

		<form class="form-search" id="search">
			<input type="text" name="s" id="s" placeholder="Pencarian">
		</form>

		<a class="search-button" onclick="openSearch()" href="javascript:void(0);">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 56.97 56.97"><path d="M55.15 51.89l-13.56-14.1A22.93 22.93 0 0 0 46.99 23c0-12.68-10.32-23-23-23s-23 10.32-23 23 10.31 23 23 23c4.76 0 9.3-1.44 13.17-4.16l13.66 14.2a2.98 2.98 0 0 0 4.24.09 3 3 0 0 0 .09-4.24zM23.98 6c9.38 0 17 7.63 17 17s-7.62 17-17 17-17-7.63-17-17 7.63-17 17-17z"/></svg>
		</a>
	</section>
</header>

