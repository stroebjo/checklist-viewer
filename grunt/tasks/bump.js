module.exports = function (grunt) {
	'use strict';

	grunt.config.set('bump', {
		options: {

			files: ['package.json'],

			// pkg has to be updated because bump-commit runs seperatly,
			// so the not-bumped version would be used to create the git tag.
			updateConfigs: ['pkg'],

			commitFiles: ['package.json', 'CHANGELOG.md'],
			commitMessage: 'chore: release v%VERSION%',


			commit: true,
			pushTo: 'origin',
			push: true



		}
	});
};

