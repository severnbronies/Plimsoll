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
