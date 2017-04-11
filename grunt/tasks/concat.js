module.exports = function (grunt) {
	'use strict';

	grunt.config.set('concat', {

		dist: {
			src: [
				'./assets/bower/jquery/dist/jquery.min.js',
				'./assets/bower/tether/dist/js/tether.min.js',
				'./assets/bower/bootstrap/dist/js/bootstrap.min.js',
				'./assets/js/trello.js',
				'./assets/js/main.js'
			],
			dest: '<%= conf.dir.compileto %>/js/main.js'
		}
	});
};

