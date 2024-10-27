module.exports = function ( grunt ) {
	'use strict';
	var pkgInfo = grunt.file.readJSON( 'package.json' );
	grunt.initConfig(
		{
			pkg: grunt.file.readJSON( 'package.json' ),

			//sass
			sass: {
				options: {
					implementation: require( 'sass' ), // Use Dart Sass
					sourceMap: true,
					outputStyle: 'expanded'
				},
				dist: {
					files: {
						'assets/css/unminify/style.css' : 'assets/sass/style.scss',
					}
				}
			},
			// watch all .scss files under the given path
			watch: {
				source: {
					files: [ 'assets/sass/**/_*.s[ac]ss' ],
					tasks: ['sass'],
					options: {
						livereload: true
					}
				}
			},
			// Compressing of javascript files
			uglify: {
				dist: {
					options: {
						banner: '/*! <%= pkg.name %> <%= pkg.version %> <%= grunt.template.today("yyyy-mm-dd h:MM:ss TT") %> */\n',
						report: 'gzip'
					},
					files: {
						'assets/js/custom.min.js'              : [ 'assets/js/unminify/custom.js' ],
						'assets/js/admin.min.js'               : [ 'assets/js/unminify/admin.js' ],
						'assets/js/swiper-custom.min.js'       : [ 'assets/js/unminify/swiper-custom.js' ],
						'js/navigation.min.js'                 : [ 'js/unminify/navigation.js' ],
						'inc/meta/assets/init.min.js'          : [ 'inc/meta/assets/unminify/init.js' ],
						'inc/meta/assets/sortable.min.js'      : [ 'inc/meta/assets/unminify/sortable.js' ],
					}
				}
			},
			// css minification
			cssmin: {
				target: {
					files: [
					{
						expand : true,
						cwd    : 'assets/css/unminify/',
						src    : ['editor-style.css'],
						dest   : 'assets/css/',
						ext    : '.min.css'
					},
					{
						expand : true,
						cwd    : 'assets/css/unminify/',
						src    : ['style.css'],
						dest   : 'assets/css/',
						ext    : '.min.css'
					},
					{
						expand : true,
						cwd    : 'assets/css/unminify/',
						src    : ['woo.css'],
						dest   : 'assets/css/',
						ext    : '.min.css'
					}
					]
				}
			},
			makepot: {
				target: {
					options: {
						domainPath: '/',
						potFilename: 'languages/constructionn.pot',
						potHeaders: {
							poedit: true,
							'x-poedit-keywordslist': true
						},
						type: 'wp-theme',
						updateTimestamp: true
					}
				}
			},
			addtextdomain: {
				options: {
					textdomain: 'constructionn',
					updateDomains: true,  // List of text domains to replace.
				},
				target: {
					files: {
						src: [
						'*.php',
						'**/*.php',
						'!node_modules/**',
						]
					}
				}
			},
			copy: {
				main: {
					options: {
						mode: true
					},
					src: [
					'**',
					'!node_modules/**',
					'!Gruntfile.js',
					'!package.json',
					'!.gitignore',
					'!package-lock.json',
					'!src/**',
					'!assets/sass/**'
					],
					dest: 'constructionn/'
				}
			},
			compress: {
				main: {
					options: {
						archive: 'constructionn_' + pkgInfo.version + '.zip',
						mode: 'zip'
					},
					files: [
					{
						src: [
							'./constructionn/**'
						]
					}
					]
				}
			},
			clean: {
				main: ["constructionn"],
				zip: ["*.zip"]
			},
			bumpup: {
				options: {
					updateProps: {
						pkg: 'package.json'
					}
				},
				file: 'package.json'
			},
			rtlcss: {
				default_options: {
					// task options
					files: [{
						'rtl.css': 'style.css',
					}]
				}
			},
			replace: {
				theme_main: {
					src: ['style.css','readme.txt' ],
					overwrite: true,
					replacements: [
					{
						from: /Version: \bv?(?:0|[1-9]\d*)\.(?:0|[1-9]\d*)\.(?:0|[1-9]\d*)(?:-[\da-z-A-Z-]+(?:\.[\da-z-A-Z-]+)*)?(?:\+[\da-z-A-Z-]+(?:\.[\da-z-A-Z-]+)*)?\b/g,
						to: 'Version: <%= pkg.version %>'
					},
					{
						from: /Stable tag: \bv?(?:0|[1-9]\d*)\.(?:0|[1-9]\d*)\.(?:0|[1-9]\d*)(?:-[\da-z-A-Z-]+(?:\.[\da-z-A-Z-]+)*)?(?:\+[\da-z-A-Z-]+(?:\.[\da-z-A-Z-]+)*)?\b/g,
						to: 'Stable tag: <%= pkg.version %>'
					}
					]
				},
				theme_updater: {
					src: [ 'updater/theme-updater.php' ],
					overwrite: true,
					replacements: [
					{
						from: /\bv?(?:0|[1-9]\d*)\.(?:0|[1-9]\d*)\.(?:0|[1-9]\d*)(?:-[\da-z-A-Z-]+(?:\.[\da-z-A-Z-]+)*)?(?:\+[\da-z-A-Z-]+(?:\.[\da-z-A-Z-]+)*)?\b/g,
						to: '<%= pkg.version %>'
					},
					]
				}
			},
		}
	);
	// Load NPM tasks to be used here
	grunt.loadNpmTasks( 'grunt-contrib-uglify' );
	grunt.loadNpmTasks( 'grunt-contrib-copy' );
	grunt.loadNpmTasks( 'grunt-contrib-compress' );
	grunt.loadNpmTasks( 'grunt-contrib-clean' );
	grunt.loadNpmTasks( 'grunt-contrib-cssmin' );
	grunt.loadNpmTasks( 'grunt-bumpup' );
	grunt.loadNpmTasks( 'grunt-text-replace' );
	grunt.loadNpmTasks( 'grunt-wp-i18n' );
	grunt.loadNpmTasks( 'grunt-sass' );
	grunt.loadNpmTasks( 'grunt-contrib-watch' );
	grunt.loadNpmTasks( 'grunt-rtlcss' );

	grunt.registerTask( 'zipfile', ['clean:zip', 'copy:main', 'compress:main', 'clean:main'] );
	grunt.registerTask(
		'release',
		function (ver) {
			var newVersion = grunt.option( 'ver' );
			if (newVersion) {
				// Replace new version
				newVersion = newVersion ? newVersion : 'patch';
				grunt.task.run( 'bumpup:' + newVersion );
				grunt.task.run( 'replace' );
				// i18n
				grunt.task.run( ['addtextdomain', 'makepot'] );
				// re create css file and min
				grunt.task.run( [ 'uglify', 'cssmin' ] );
			}
		}
	);
	grunt.registerTask( 'default', ['uglify', 'addtextdomain', 'makepot', 'cssmin'] );
	grunt.registerTask( 'sass-watch', ['sass', 'watch'] );
};