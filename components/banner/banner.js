export default class Banner {
	constructor($module) {
		this.$module = $module;
		this.$dismiss = this.$module.querySelector(".sb-banner__dismiss");
		if (this.$dismiss) {
			this.bindControls();
		}
	}
	bindControls() {
		this.$dismiss.addEventListener("click", () => {
			const bannerId = this.$module.getAttribute("id");
			this.$module.remove();
			this.createCookie(bannerId, "1", 28);
		});
	}
	createCookie(name, value, days) {
		const expiryDate = new Date(
			new Date().getTime() + days * 24 * 60 * 60 * 1000
		);
		document.cookie =
			name + "=" + value + ";path=/;expires=" + expiryDate.toUTCString();
	}
}
