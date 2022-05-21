---
to: <%= h.componentPath() %>/<%= h.changeCase.paramCase(name) %>/macro.twig
---

{% macro <%= h.namespace() %><%= h.changeCase.pascalCase(name) %>(params) %}
	{%- include "@components/<%= h.changeCase.paramCase(name) %>/template.twig" -%}
{% endmacro %}