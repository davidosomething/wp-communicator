<?php
/**
 * Plugin Name: Communicator
 * Plugin URI: http://github.com/davidosomething/wp-communicator
 * Description: Post-type based chat for WordPress users
 * Version: 1.0
 * Author: David O'Trakoun (@davidosomething)
 * Author URI: http://www.davidosomething.com/
 * License: GPLv2
 * Copyright 2011 David O'Trakoun (email : me@davidosomething.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */

class WP_Communicator 
{
	private $plugin_name = "communicator";

	/**
	 * @return void
	 */
	public function __construct() {
		add_action('init', array(&$this, 'init_custom_post_types'));
		add_action('init', array(&$this, 'init_styles'));
		add_action('init', array(&$this, 'init_scripts'));
		add_action('admin_menu', array(&$this, 'init_admin_menu'), 9);

		add_action('wp_dashboard_setup', array(&$this, 'init_dashboard'));
		add_action('wp_ajax_communicator_submit_post', array(&$this, 'ajax_submit_post'));
	}

	/**
	 * @return void
	 */
	function init_scripts() {
		if(!is_admin()) {
			wp_deregister_script('jquery');
		  wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js');
		  wp_enqueue_script('jquery');

			/* for this version of the plugin, we're only doing dashboard stuff
			// Only enqueue the script if it actually exists.
			if(file_exists(dirname(__FILE__) . '/js/script.js')) {
				if(function_exists('plugins_url')) {
					wp_enqueue_script($this->plugin_name . '-script', 
						plugins_url('/js/script.js', __FILE__), array('jquery'), '1.0', 
						true);
					wp_localize_script($this->plugin_name . '-script', 'communicator', array(
							'ajaxUrl' => admin_url('admin-ajax.php')
						));
				}
			}
			 */
		}
	}
	
	/**
	 * Loading the stylesheet for this plugin.
	 * @return void
	 */
	function init_styles() {
		if (is_admin()) {
			if (file_exists(dirname(__FILE__) . '/css/admin.css')) {
				/*
					wp_enqueue_style($this->plugin_name . '_stylesheet',
					WP_PLUGIN_URL . '/' . $this->plugin_name . '/css/admin.css', 
					array(), '1.0', 'all');
				 */
				}
		}
		else {
			if(file_exists(dirname(__FILE__) . '/css/style.css') && function_exists('plugins_url')) {
				wp_enqueue_style($this->plugin_name . '-stylesheet',
					plugins_url('/css/style.css', __FILE__),
					array(), '1.0', 'all');
			}
		}
	}
	
	/**
	 * Loading custom post types and taxonomies for this plugin.
	 * @return void
	 */
	function init_custom_post_types() {	require 'inc/post_types.php'; }

	/**
	 * Adds a new menu with the name "My Admin Menu" and let's anyone that
	 * can publish posts be able to use it.
	 * @return void
	 */
	function init_admin_menu() {
		add_menu_page('Communicator', 'Communicator',
			'manage_options', $this->plugin_name,
			array(&$this, 'menu_page'),
			'',
			200);

	/*	
		add_submenu_page($this->plugin_name, 'Messages', 'Messages Admin',
			'manage_options', $this->plugin_name . '-messages',
			array(&$this, 'messages_submenu_page'));
	 */
		 
	}
	function menu_page() { require 'views/menu.php'; }

	/**
	 * Do stuff on the dashboard page
	 * @return void
	 */
	function init_dashboard() {
		// add widgets
		wp_add_dashboard_widget($this->plugin_name.'_dashboard_widget', 
			'Communicator', array(&$this, 'dashboard_widget'));

		// add dashbord JS
		// Only enqueue the script if it actually exists.
		if(file_exists(dirname(__FILE__) . '/js/dashboard.js')) {
			wp_enqueue_script($this->plugin_name . '-script', 
				plugins_url('/js/dashboard.js', __FILE__), 
				array('jquery'), '1.0', true);
		}
	}
	function dashboard_widget() { require 'views/widget-dashboard.php'; }

	/**
	 * AJAX called function callback
	 * run using jquery with action communicator_submit_post 
	 */
	function ajax_submit_post() {
		$author = "DEBUG";
		$body = "DEBUG";
		$datetime = "DEBUG";

		$response = array(
			'what'	 => 'communicator',
			'action' => 'add_message',
			'id'		 => $new_post_id,
			'data'	 => '
<article>
	<span class="communicator-message-author">'.$author.'</span>
	<span class="communicator-message-body">'.$body.'</span>
	<span class="communicator-message-datetime">'.$datetime.'</span>
</article>
									'
		);
		$xml_response = new WP_Ajax_Response($response);
		$xml_response->send();
	}
}

/**
 * Register the plugin
 */
$wp_communicator = new WP_Communicator();
