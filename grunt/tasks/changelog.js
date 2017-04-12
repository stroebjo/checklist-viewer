module.exports = function (grunt) {
	'use strict';

	grunt.config.set('conventionalChangelog', {
		options: {
			changelogOpts: {
				// conventional-changelog options go here
				preset: 'angular'
			}
		},
		release: {
			src: 'CHANGELOG.md'
		}
	});
};

