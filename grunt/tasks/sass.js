module.exports = function (grunt) {
	'use strict';

	grunt.config.set('sass', {

		dist: {
			options: {
				sourceMap: true,
				//require: ['sass-json-vars'],
				outputStyle: 'compressed',
				precision: 8 // TWBS requires precision f 8
			},

			files: [{
				expand: true,
				cwd: '<%= conf.dir.sass %>',
				src: ['**/*.scss'],
				dest: '<%= conf.dir.compileto %>/css/',
				ext: '.css'
			}]
		}
	});
};

