<?php

if (function_exists('acf_add_options_page')) {
	acf_add_options_sub_page([
		'page_title' => 'API Keys',
		'menu_title' => 'API Keys',
		'parent_slug' => 'website-settings',
	]);
	acf_add_local_field_group([
		'key' => 'group_5f6147295269e',
		'title' => 'API keys',
		'fields' => [
			[
				'key' => 'field_5f61472fc7ad5',
				'label' => 'Google Maps API key',
				'name' => 'api_google_maps',
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
				'key' => 'field_5f9764a1e3b7a',
				'label' => 'Minecraft server URL',
				'name' => 'api_minecraft_server_url',
				'type' => 'text',
				'instructions' =>
					'The Minecraft server URL, including port number, if one is required. For example: mc.domainname.com:5756',
				'required' => 0,
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
		],
		'location' => [
			[
				[
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-api-keys',
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
