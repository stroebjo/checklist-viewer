module.exports = function (grunt) {
	'use strict';

	grunt.config.set('postcss', {
		options: {
			map: true,
			processors: [
				require('autoprefixer')({}),

				require('postcss-inline-svg')({
					path: 'dist/build/',
					encode: true
				}),
				require('postcss-svgo'),

				require('postcss-assets')({
					loadPaths: ['dist/build/'],
					relative: true
				})
			]
		},

		dist: {
			src: 'dist/build/css/*.css'
		}
	});
};

