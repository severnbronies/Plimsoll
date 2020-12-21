<?php

function sb_meet_archive_rewrites()
{
	add_rewrite_rule(
		'meet/([0-9]{4})/([0-9]{2})/?$',
		'index.php?pagename=meet&meet_year=$matches[1]&meet_month=$matches[2]',
		'top'
	);
	add_rewrite_rule(
		'meet/([0-9]{4})/?$',
		'index.php?pagename=meet&meet_year=$matches[1]',
		'top'
	);
}

add_action('init', 'sb_meet_archive_rewrites');

function sb_query_vars($query_vars)
{
	$query_vars[] = 'meet_year';
	$query_vars[] = 'meet_month';
	return $query_vars;
}

add_filter('query_vars', 'sb_query_vars');

if (function_exists('acf_add_local_field_group')):
	acf_add_local_field_group([
		'key' => 'group_5fe09157011c5',
		'title' => 'Meet archive options',
		'fields' => [
			[
				'key' => 'field_5fe09192d2c7e',
				'label' => 'Empty State Emoji',
				'name' => 'meet_empty_state_emoji',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			],
			[
				'key' => 'field_5fe09168d2c7d',
				'label' => 'Empty State Text',
				'name' => 'meet_empty_state_text',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
				'default_value' => '',
				'tabs' => 'all',
				'toolbar' => 'basic',
				'media_upload' => 0,
				'delay' => 0,
			],
		],
		'location' => [
			[
				[
					'param' => 'page',
					'operator' => '==',
					'value' => '1749',
				],
			],
		],
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	]);
endif;
