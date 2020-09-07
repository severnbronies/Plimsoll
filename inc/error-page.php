<?php

if (function_exists('acf_add_options_page')) {
	acf_add_options_sub_page([
		'page_title' => '404 Page',
		'menu_title' => '404 Page',
		'parent_slug' => 'website-settings',
	]);
	acf_add_local_field_group([
		'key' => 'group_5f5691b67a46a',
		'title' => '404 Page',
		'fields' => [
			[
				'key' => 'field_5f5691c7234ab',
				'label' => 'Heading',
				'name' => 'error404_heading',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
				'default_value' => 'Page not found',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			],
			[
				'key' => 'field_5f5691df234ac',
				'label' => 'Content',
				'name' => 'error404_content',
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
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-404-page',
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
}
