<?php

if (function_exists('acf_add_local_field_group')):
	acf_add_local_field_group([
		'key' => 'group_6005ec5ca719a',
		'title' => 'Stream team members',
		'fields' => [
			[
				'key' => 'field_600624d744269',
				'label' => 'Stream calendar URL',
				'name' => 'stream_calendar_url',
				'type' => 'url',
				'instructions' =>
					'Fully qualified URL to the calendar. Shown in iframe when no one is currently streaming.',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
				'default_value' => '',
				'placeholder' => '',
			],
			[
				'key' => 'field_6005ec716ee33',
				'label' => 'Stream team members',
				'name' => 'stream_team_members',
				'type' => 'textarea',
				'instructions' => 'Newline separated list of Twitch usernames.',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'new_lines' => '',
			],
		],
		'location' => [
			[
				[
					'param' => 'post_template',
					'operator' => '==',
					'value' => 'page-stream-team.php',
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
