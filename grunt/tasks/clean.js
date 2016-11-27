module.exports = function (grunt) {
	'use strict';

	grunt.config.set('clean', {
		svg: {
			src: ["tmp/svg"]
		},
		dist: {
			src: ["dist/"]
		}
	});
};

