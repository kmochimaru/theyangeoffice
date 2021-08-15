module.exports = function(grunt) {
  grunt.initConfig({
    watch: {
      options: {
        livereload: true
      },
      main: {
        files: ["*html"]
      },
      js: {
        files: ["assets/js/*.js"]
      },
      php: {
        files: [
          "application/controllers/*.php",
          "application/models/*.php",
          "application/views/*.php",
          "application/views/layout/*.php",
          "application/views/modal/*.php",
          "application/views/ajax/*.php"
        ]
      },
      css: {
        files: ["assets/css/*.css"]
      }
    }
  });
  grunt.loadNpmTasks("grunt-contrib-watch");
  grunt.registerTask("default", ["watch"]);
};
