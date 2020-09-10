import Fitty from "fitty";

export default class MeetDate {
	constructor($module) {
		this.$module = $module;
		// this.$module.childNodes.forEach((child) => {
		// 	console.log(child);
		// 	Fitty(child);
		// });
		for (let child of this.$module.childNodes) {
			if (child.nodeType !== Node.TEXT_NODE) {
				Fitty(child);
			}
		}
	}
}
