---
to: <%= h.componentPath() %>/<%= h.changeCase.paramCase(name) %>/<%= h.changeCase.paramCase(name) %>.js
---

class <%= h.namespace() %><%= h.changeCase.pascalCase(name) %> {
	constructor($module) {
		this.$module = $module;
	}
};

export default <%= h.namespace() %><%= h.changeCase.pascalCase(name) %>;