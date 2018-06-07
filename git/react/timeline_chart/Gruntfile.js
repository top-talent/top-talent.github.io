'use strict';
var webpack = require('webpack');

module.exports = function (grunt) {
  require('load-grunt-tasks')(grunt);

  grunt.initConfig({
    webpack: {
      options: {
        entry: {
          SimpleFlameChart: './app/SimpleFlameChart.js'
        },
        output: {
          filename: './dist/[name].js'
        },
        plugins: [new webpack.EnvironmentPlugin(['NODE_ENV'])],
        context: __dirname,
        module: {
          loaders: [
            { test: /.js?$/, loader: 'babel-loader', exclude: /node_modules/ },
            { test: /\.less$/, loader: 'style-loader!css-loader!less-loader' },
            { test: /\.css$/, loader: 'style-loader!css-loader' },
            { test: /\.png$/, loader: 'url-loader?limit=100000' },
            { test: /\.jpg$/, loader: 'file-loader' }
          ]
        }
      },
      dist: {},
      dev: {
        watch: true,
        keepalive: true
      }
    },
    babel: { dist: { files: [{ expand: true, cwd: 'src/', src: ['**/*.js'], dest: 'lib/', ext: '.js' }] } },
    uglify: { dist: { files: [{ expand: true, cwd: 'dist/', src: ['**/*.js'], dest: 'dist/', ext: '.js' }] } }

  });

  grunt.registerTask('watch', ['webpack:dev']);
  grunt.registerTask('build', ['webpack:dist', 'uglify:dist', 'babel:dist']);
};
