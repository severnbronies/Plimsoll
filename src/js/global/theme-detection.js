// This script runs and pins some observers on particular media queries, then
// applies classes for those queries to the <html> element, so we can style
// against them.
//
// We do it this way, rather than having the queries repeated across CSS/JS, so
// that we can provide our own feature for users to enable, disable, or
// override them, should they wish to do so.
//
// TODO: Add localStorage checks to see if any of these have been manually overridden.

(function () {
	// Detectors
	const d = document.documentElement.classList;
	const ls = window.localStorage;

	const factory = function (query, className) {
		query = window.matchMedia(query);
		const check = () => {
			if (query.matches) {
				d.add(className);
			} else {
				d.remove(className);
			}
		};
		query.addEventListener("change", check);
		check();
	};

	factory("(prefers-contrast: more)", "high-contrast");
	factory("(prefers-color-scheme: dark)", "dark-theme");
	factory("(prefers-reduced-motion: reduce)", "reduce-motion");
	factory("(prefers-reduced-transparency: reduce)", "reduce-transparency");
	factory("(prefers-reduced-data: reduce)", "reduce-data");
})();
