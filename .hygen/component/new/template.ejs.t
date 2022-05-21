---
to: <%= h.componentPath() %>/<%= h.changeCase.paramCase(name) %>/template.twig
---

<div 
	data-module="<%= h.namespace() %>-<%= h.changeCase.paramCase(name) %>"
	class="<%= h.namespace() %>-<%= h.changeCase.paramCase(name) %> {%- if params.classes %} {{ params.classes }}{% endif %}"
	{%- for attribute, value in params.attributes %} {{ attribute }}="{{ value }}"{% endfor %}>
</div>