<?php

if (!class_exists('SB_Logo_Customize')) {
	class SB_Logo_Customize
	{
		public static function register($wp_customize)
		{
			/**
			 * Site Branding
			 */

			$wp_customize->add_section('branding', [
				'title' => 'Branding',
				'priority' => 21,
			]);

			/* Logo URL */
			$wp_customize->add_setting('custom_logo', [
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
			]);

			$wp_customize->add_control('custom_logo', [
				'type' => 'url',
				'section' => 'branding',
				'priority' => 10,
				'label' => __('Logo URL', 'sb'),
			]);
		}
	}
	add_action('customize_register', ['SB_Logo_Customize', 'register']);
}
