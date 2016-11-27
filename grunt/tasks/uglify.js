module.exports = function (grunt) {
	'use strict';

	grunt.config.set('uglify', {

		options: {
			preserveComments: 'some' // preserve all comments with /*! (licenses, i.e.)
		},

		build: {
			src:  '<%= conf.dir.compileto %>/js/main.js',
			dest: '<%= conf.dir.compileto %>/js/main.min.js'
		}
	});
};

