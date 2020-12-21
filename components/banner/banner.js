export default class Banner {
	constructor($module) {
		this.$module = $module;
		this.bannerId = $module.getAttribute("id");
		this.$dismiss = $module.querySelector(".js-banner-dismiss");
		if (this.$dismiss) {
			this.bindControls();
		}
		if (!this.isBannerDismissed()) {
			$module.removeAttribute("hidden");
		}
	}
	bindControls() {
		this.$dismiss.addEventListener("click", () => {
			this.$module.setAttribute("hidden", "hidden");
			this.dismissBanner();
		});
	}
	isBannerDismissed() {
		return localStorage.getItem(this.bannerId) !== null;
	}
	dismissBanner() {
		try {
			localStorage.setItem(this.bannerId, true);
		} catch (ex) {
			console.error(ex);
		}
	}
}
