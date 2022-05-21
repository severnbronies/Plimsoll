---
to: <%= h.componentPath() %>/<%= h.changeCase.paramCase(name) %>/<%= h.changeCase.paramCase(name) %>.twig
---

{% from "components::<%= h.changeCase.paramCase(name) %>/macro.twig" import <%= h.namespace() %><%= h.changeCase.pascalCase(name) %> %}

{{ <%= h.namespace() %><%= h.changeCase.pascalCase(name) %>({
	
}) }}