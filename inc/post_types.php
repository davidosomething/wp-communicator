<?php
$labels = array(
	'name'							 => _x('Messages', 'general name'),
	'singular_name'			 => _x('Message', 'singular name'),
	'add_new'						 => _x('New message', 'message'),
	'add_new_item'			 => __('Add new message'),
	'edit_item'					 => __('Edit message'),
	'new_item'					 => __('New message'),
	'all_items'					 => __('All messages'),
	'view_item'					 => __('Show message'),
	'search_items'			 => __('Search message'),
	'not_found'					 => __('No messages found'),
	'not_found_in_trash' => __('No messages in trash'),
	'parent_item_colon'	 => '',
	'menu_name'					 => 'Messages'
);
$args = array(
	'labels'							=> $labels,
	'public'							=> true,
	'publicly_queryable'  => true,
	'show_ui'						  => true,
	'show_in_menu'			  => true,
	'exclude_from_search' => true,
	'rewrite'							=> false,
	'capability_type'			=> 'post',
	'has_archive'					=> false,
	'hierarchical'				=> false,
	'menu_position'				=> 201,
	'can_export'					=> false,
	'supports'						=> array('title', 'editor', 'author', 'comments', 'custom-fields')
);
//			'capability_type'			=> 'communicator',
//			'register_meta_box_cb' => 'messages_meta_box'
register_post_type('communicator_message', $args);
