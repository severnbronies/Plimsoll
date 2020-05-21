<?php

function sb_site_description($echo = true)
{
	$description = get_bloginfo('description');

	if (!$description) {
		return;
	}

	$wrapper = '<div class="sb-site-description">%s</div>';

	$html = sprintf($wrapper, esc_html($description));
	$html = apply_filters('sb_site_description', $html, $description, $wrapper);

	if (!$echo) {
		return $html;
	}

	echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
