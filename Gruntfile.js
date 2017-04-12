module.exports = function(grunt) {
	'use strict';

	// Load all grunt tasks
	require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

    // Load the configuration and save in grunt config
	var pkg  = grunt.file.readJSON('package.json');
	var conf = pkg.pbi_pattern;

    grunt.initConfig({
        pkg: pkg
	});

    grunt.config('conf', conf);

	// Load subtasks
	grunt.loadTasks('grunt/tasks/');


    grunt.registerTask('default', ['clean:dist', 'js', 'css']);

	grunt.registerTask('js', ['concat:dist', 'uglify']);

	grunt.registerTask('css', ['sass', 'postcss']);

	grunt.registerTask('svg', [ 'clean:svg', 'svgmin']);

	grunt.registerTask('bumpfix',     ['bump-only', 'conventionalChangelog', 'bump-commit']);
	grunt.registerTask('bumpminor',   ['bump-only:minor', 'conventionalChangelog', 'bump-commit']);
	grunt.registerTask('bumpmajor',   ['bump-only:major', 'conventionalChangelog', 'bump-commit']);
};
