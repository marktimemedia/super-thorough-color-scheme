<?php
/*
Plugin Name: Super Thorough Admin Color Scheme
Description: A super-thorough admin color scheme, which happens to be pink.
Author: Marktime Media
Author URI: http://marktimemedia.com
Version:1.1.2
License: GPLv2
 
 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License version 2,
 as published by the Free Software Foundation.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.See the
 GNU General Public License for more details.
 
 The license for this software can likely be found here:
 http://www.gnu.org/licenses/gpl-2.0.html

*/

class st_Admin_Color_Scheme {

	function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'load_default_css') );
		add_action( 'admin_init', array( $this, 'add_color_scheme') );
	}

	/**
	 * Register the custom admin color scheme
	 */
	function add_color_scheme() { // child theme

		if ( file_exists( get_stylesheet_directory()."/admin-color.css" ) ) {
					
			wp_admin_css_color( 'st' , __( 'Super Thorough', 'st-color-scheme' ), get_stylesheet_directory_uri() . '/admin-color.css',
			array( '#474247', '#de1e7e', '#ec76b1', '#d51d79' ) // your custom colors as an admin demo
			);
					
		}
		
		elseif ( file_exists( get_template_directory()."/admin-color.css" ) ) { // parent theme
								
			wp_admin_css_color( 'st' , __( 'Super Thorough', 'st-color-scheme' ), get_template_directory_uri() . '/admin-color.css',
			array( '#474247', '#de1e7e', '#ec76b1', '#d51d79' ) // your custom colors as an admin demo
			);
		
		}
	
		else { // plugin
			
			wp_admin_css_color( 'st' , __( 'Super Thorough', 'st-color-scheme' ), plugins_url( 'st-admin.css', __FILE__ ),
			array( '#474247', '#de1e7e', '#ec76b1', '#d51d79' ) // your custom colors as an admin demo
			);
		
		}

	}

	/**
	 * Make sure core's default `colors.css` gets enqueued, since we can't
	 * @import it from a plugin stylesheet. Also force-load the default colors
	 * on the profile screens, so the JS preview isn't broken-looking.
	 *
	 * Copied from Admin Color Schemes - http://wordpress.org/plugins/admin-color-schemes/
	 */
	function load_default_css() {

		global $wp_styles;

		$color_scheme = get_user_option( 'admin_color' );

		if ( 'st' === $color_scheme || in_array( get_current_screen()->base, array( 'profile', 'profile-network' ) ) ) {
			$wp_styles->registered[ 'colors' ]->deps[] = 'colors-fresh';
		}

	}
}

new st_Admin_Color_Scheme();