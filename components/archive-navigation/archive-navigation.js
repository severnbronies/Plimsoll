export default class ArchiveNavigation {
	constructor($module) {
		this.$module = $module;
		this.$list = $module.querySelector(".sb-archive-navigation__list");
		this.rememberScrollPos();
	}
	rememberScrollPos() {
		const sessionId = "archive-nav-scroll-pos";
		const top = sessionStorage.getItem(sessionId);
		if (top !== null) {
			this.$list.scrollTop = parseInt(top, 10);
		}
		window.addEventListener("beforeunload", () => {
			sessionStorage.setItem(sessionId, this.$list.scrollTop);
			console.log(this.$list.scrollTop);
		});
	}
}
