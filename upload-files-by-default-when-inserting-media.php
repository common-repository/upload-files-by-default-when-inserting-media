<?php
/*
Plugin Name: Upload Files by Default when Inserting Media
Plugin URI: http://cubecolour.co.uk/insert-media-by-default
Description: Makes the upload files tab active rather than the Media Library Tab when adding images or other media to a page or post.
Author: cubecolour
Version: 1.0.0
Author URI: http://cubecolour.co.uk/
License: GPL

  Copyright 2014-2022 Michael Atkins

  Licenced under the GNU GPL:

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

*/

if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Add Links in Plugins Table
 *
 */
add_filter( 'plugin_row_meta', 'cc_defaultmediatab_meta_links', 10, 2 );
function cc_defaultmediatab_meta_links( $links, $file ) {

	$plugin = plugin_basename(__FILE__);

	//*	create the links
	if ( $file == $plugin ) {

		$supportlink = 'https://wordpress.org/support/plugin/upload-files-by-default-when-inserting-media';
		$donatelink = 'http://cubecolour.co.uk/wp';
		$reviewlink = 'https://wordpress.org/support/view/plugin-reviews/upload-files-by-default-when-inserting-media?rate=5#postform';
		$iconstyle = 'style="-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;font-size: 14px;margin: 4px 0 -4px;"';
		$twitterlink = 'http://twitter.com/cubecolour';

		return array_merge( $links, array(
			'<a href="' . $donatelink . '"><span class="dashicons dashicons-heart"' . $iconstyle . 'title="Donate"></span></a>',
			'<a href="' . $supportlink . '"> <span class="dashicons dashicons-lightbulb" ' . $iconstyle . 'title="Support"></span></a>',
			'<a href="' . $twitterlink . '"><span class="dashicons dashicons-twitter" ' . $iconstyle . 'title="Cubecolour on Twitter"></span></a>',
			'<a href="' . $reviewlink . '"><span class="dashicons dashicons-star-filled"' . $iconstyle . 'title="Review"></span></a>'
		) );
	}

	return $links;
}


/**
 * Change the active tab to *Upload Files* when inserting media
 *
 */
function cc_media_default() {
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($){ wp.media.controller.Library.prototype.defaults.contentUserSetting=false; });
	</script>
	<?php
}

add_action( 'admin_footer-post-new.php', 'cc_media_default' );
add_action( 'admin_footer-post.php', 'cc_media_default' );
