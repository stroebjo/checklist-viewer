module.exports = function (grunt) {
	'use strict';

	grunt.config.set('copy', {

		fonts: {
			files: [
				{expand: true, cwd: '<%= conf.dir.assets %>', src: ['fonts/**'], dest: '<%= conf.dir.compileto %>'},
			]
		},
		img: {
			files: [
				{expand: true, cwd: '<%= conf.dir.assets %>', src: ['img/*'], dest: '<%= conf.dir.compileto %>', filter: 'isFile'},
			]
		},
		content: {
			files: [
				{expand: true, cwd: '<%= conf.dir.assets %>', src: ['content/**'], dest: '<%= conf.dir.compileto %>'},
			]
		},
		doku: {
			files: [
				{expand: true, cwd: '<%= conf.dir.assets %>', src: ['doku/**'], dest: '<%= conf.dir.compileto %>'},
			]
		}

	});
};

