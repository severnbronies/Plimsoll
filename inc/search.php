<?php

/**
 * Prettify search URLs because WordPress doesn't do that by default.
 */

function sb_search_url_rewrite_rule()
{
	if (is_search() && !empty($_GET['s'])) {
		wp_redirect(home_url("/search/") . urlencode(get_query_var('s')));
		exit();
	}
}
add_action("template_redirect", "sb_search_url_rewrite_rule");
