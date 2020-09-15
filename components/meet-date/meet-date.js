export default class MeetDate {
	constructor($module) {
		this.$module = $module;
		this.nodes = this.nodeList();
		this.bindEvents();
	}
	nodeList() {
		return [...this.$module.childNodes].filter(
			node => node.nodeType !== Node.TEXT_NODE
		);
	}
	bindEvents() {
		window.addEventListener("load", this.reflowAll.bind(this));
		window.addEventListener("resize", this.reflowAll.bind(this));
		window.addEventListener("orientationchange", this.reflowAll.bind(this));
	}
	reflowAll() {
		this.nodes.forEach(el => this.resetNode(el));
		this.containerWidth = this.$module.getBoundingClientRect().width;
		this.nodes.forEach(el => this.sizeNode(el));
	}
	resetNode($node) {
		$node.removeAttribute("style");
	}
	sizeNode($node) {
		if ($node.fitInitialWidth) {
			const initialWidth = $node.fitInitialWidth;
		} else {
			$node.fitInitialWidth = $node.getBoundingClientRect().width;
		}
		$node.style.fontSize = `${this.containerWidth / $node.fitInitialWidth}em`;
	}
}
