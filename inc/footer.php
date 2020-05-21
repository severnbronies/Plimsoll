<?php

if (!class_exists('SB_Footer_Customize')) {
	class SB_Footer_Customize
	{
		public static function register($wp_customize)
		{
			/**
			 * Footer boilerplate
			 */

			$wp_customize->add_section('footer', [
				'title' => 'Footer',
				'priority' => 121,
			]);

			/* Footer legal copy */
			$wp_customize->add_setting('footer_boilerplate', [
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
			]);

			$wp_customize->add_control('footer_boilerplate', [
				'type' => 'textarea',
				'section' => 'footer',
				'priority' => 10,
				'label' => __('Legal boilerplate', 'sb'),
				'description' => __(
					'Copyright, trademark and company information.',
					'sb'
				),
			]);
		}
	}
	add_action('customize_register', ['SB_Footer_Customize', 'register']);
}
