<?php

if (function_exists('acf_add_options_page')) {
	acf_add_options_sub_page([
		'page_title' => 'Footer',
		'menu_title' => 'Footer',
		'parent_slug' => 'website-settings',
	]);

	acf_add_local_field_group([
		'key' => 'group_5ec90b3b9658c',
		'title' => 'Legal copy',
		'fields' => [
			[
				'key' => 'field_5ec90b49f6c88',
				'label' => 'Legal copy',
				'name' => 'footer_legal_copy',
				'type' => 'textarea',
				'instructions' =>
					'Legal copy to appear in the footer, such as copyrights, company information, disclaimers, and attributions.',
				'required' => 0,
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
				'new_lines' => 'br',
			],
		],
		'location' => [
			[
				[
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-footer',
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

	acf_add_local_field_group([
		'key' => 'group_5ec909b35e5a0',
		'title' => 'Meet update newsletter form',
		'fields' => [
			[
				'key' => 'field_5ec90a0c774a4',
				'label' => 'Show meet updates sign up?',
				'name' => 'footer_newsletter_visible',
				'type' => 'radio',
				'instructions' =>
					'Whether the meet update newsletter sign up form is visible or not.',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
				'choices' => [
					'true' => 'Yes, show the form.',
					'false' => 'No, hide the form.',
				],
				'allow_null' => 0,
				'other_choice' => 0,
				'default_value' => '',
				'layout' => 'horizontal',
				'return_format' => 'value',
				'save_other_choice' => 0,
			],
			[
				'key' => 'field_5ec90ac5774a7',
				'label' => 'Heading',
				'name' => 'footer_newsletter_heading',
				'type' => 'text',
				'instructions' => 'Sign up form heading',
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
				'key' => 'field_5ec90ae3774a8',
				'label' => 'Description',
				'name' => 'footer_newsletter_description',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 0,
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
				'delay' => 1,
			],
			[
				'key' => 'field_5ec90a95774a6',
				'label' => 'Placeholder email address',
				'name' => 'footer_newsletter_placeholder',
				'type' => 'text',
				'instructions' =>
					'A dummy email address to show in the input. Make sure it\'s not real.',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
				'default_value' => 'celestia@canterlot.gov',
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
					'value' => 'acf-options-footer',
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
