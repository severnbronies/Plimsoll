/**
 * This file provides an `initAll` function that will trawl through the page,
 * pick up any modules it knows have associated JS, and will initialise the JS
 * class on that component. It will only do this if the component is explicitly
 * listed here, and only if it finds the component on the page, however it
 * loads the JS for *ALL* components, as they're all imported at once.
 *
 * You can keep JS filesizes small by creating different entry files that only
 * include the components needed for a page or section.
 *
 * This file also exports all component classes so that they can be initialized
 * individually, if necessary.
 *
 * To initialise everything in this file at once: `window.sb.initAll()`
 */

import "what-input";

import "./vendor/basket";

import ArchiveNavigation from "../../components/archive-navigation/archive-navigation";
import Banner from "../../components/banner/banner";
import Map from "../../components/map/map";
import MeetDate from "../../components/meet-date/meet-date";
import Modal from "../../components/modal/modal";

function initAll(options) {
	options = typeof options !== "undefined" ? options : {};

	// Scope initialization to only certain parts of the page
	// Defaults to entire document if not set
	const scope = typeof options.scope !== "undefined" ? options.scope : document;

	scope.querySelectorAll('[data-module="sb-archive-navigation"]').forEach(m => {
		new ArchiveNavigation(m);
	});

	scope.querySelectorAll('[data-module="sb-banner"]').forEach(m => {
		new Banner(m);
	});

	scope.querySelectorAll('[data-module="sb-meet-date"]').forEach(m => {
		new MeetDate(m);
	});

	scope.querySelectorAll('[data-module="sb-modal"]').forEach(m => {
		new Modal(m);
	});
}

export { initAll, Banner, Map, MeetDate, Modal };
