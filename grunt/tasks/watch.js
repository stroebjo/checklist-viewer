module.exports = function (grunt) {
	'use strict';

	grunt.config.set('watch', {

		assets: {
			files: [
				'<%= conf.dir.assets %>/img/*',
				'<%= conf.dir.assets %>/fonts/*',
				'<%= conf.dir.assets %>/doku/**/*'
			],
			tasks: ['copy']
		},

		jshint: {
			files: [
				'<%= jshint.all %>'
			],
			tasks: ['jshint']
		},

		svg: {
			files: [
				'<%= conf.dir.assets %>/svg/**/*.svg'
			],
			tasks: ['svg']
		},


		images: {
			files: ['images/**/*.{png,jpg,gif,PNG,JPG,GIF}'],
			tasks: ['imagemin']
		},

		// no required in local dev
		//requirejs: {
		//	files: [
		//		'<%= conf.dir.assets %>/js/*',
		//		'<%= conf.dir.source %>/**/*.js'
		//	],
		//
		//	tasks: 'requirejs'
		//},

		scss: {
			files: ['<%= conf.dir.assets %>/scss/**/*.scss', '<%= conf.dir.source %>/**/*.scss', ],
			tasks: ['css']
		},

		pngicon: {
			files: ['<%= conf.dir.assets %>/img/icon-2x/*.png'],
			tasks: ['css_sprite']
		}


	});
};

