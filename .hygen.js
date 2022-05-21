const fs = require("fs");
const config = JSON.parse(fs.readFileSync("./.config.json", "utf8"));

module.exports = {
	templates: `${__dirname}/.hygen`,
	helpers: {
		namespace: () => {
			return config.namespace;
		},
		componentPath: () => {
			return config.paths.components_blocks;
		},
		cssPath: () => {
			return config.paths.src_css;
		},
	},
};
