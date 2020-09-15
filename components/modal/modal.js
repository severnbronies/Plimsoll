import MicroModal from "micromodal";

export default class Modal {
	constructor($module) {
		this.$module = $module;
		MicroModal.init({
			disableScroll: true,
			awaitOpenAnimation: true,
			awaitCloseAnimation: true
		});
	}
}
