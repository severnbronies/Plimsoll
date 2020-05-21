export default class Skiplink {
	constructor($module) {
		this.$module = $module;
		// Put code here
		this.bindControls();
	}
	bindControls() {
		this.$module.addEventListener("click", () => {
			// Extract the ID from the link and find where the target lives on the page
			const $target = document.querySelector(
				this.$module.attributes.href.value
			);
			console.log({ $target });
			if ($target) {
				// Move keyboard focus to target, temporarily assigning a tabindex so we can do so cross-browserly
				$target.setAttribute("tabindex", "-1");
				$target.addEventListener("blur", () => {
					$target.removeAttribute("tabindex");
				});
				$target.focus();
			}
		});
	}
}
