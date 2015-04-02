<?php
/**
 * Plugin Name: ng-template
 * Plugin URI: https://github.com/stepankarslyan
 * Description: Wordpress plugin for adding AngularJS pages in wordpress.
 * Version: 1.0.3
 * Author: Stepan Karslyan
 * Author URI: stepan.karslyan@gmail.com
 * License: A short license name. Example: GPL2
 */

require 'plugin-updates/plugin-update-checker.php';
$MyUpdateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/stepankarslyan/wp_plugin/blob/master/metadata.json',
    __FILE__
);


//creating a custom page
function auto_create_page() {
  
 
  
//the main page content
  	$page_content = '<script src="/wp-content/plugins/ng-template/ng/lib/angular/angular.min.js"></script>
		<script src="/wp-content/plugins/ng-template/ng/lib/angular/ng-route.min.js"></script>
		<script src="/wp-content/plugins/ng-template/ng/lib/jquery/jquery.min.js"></script>
		<link rel="/wp-content/plugins/ng-template/ng/lib/bootstrap/css/bootstrap.min.js">
		<div ng-app="app">
			<div ng-view></div>
		<div>
		<script src="/wp-content/plugins/ng-template/ng/js/app.js"></script>
		<script src="/wp-content/plugins/ng-template/ng/js/controller/userCtrl.js"></script>
		<script src="/wp-content/plugins/ng-template/ng/js/controller/detailCtrl.js"></script>
		<script src="/wp-content/plugins/ng-template/ng/js/service/userService.js"></script>
	';
  //custom page
	$my_ng_page = array(
	  
	  'post_title'    => 'Angular page',
	  'post_author'   => 'stepan',
	  'post_content'  => $page_content,
	  'post_status'   => 'publish',
	  'post_type'     => 'page'
	);

  //inseting page automatically
wp_insert_post($my_ng_page);
  
}

//function to run when plugin is activated
function run_at_activation(){
  
  $page_id = post_exists( 'Angular page' );
  	if (!$post_id) {
		auto_create_page();
  }
  
  
}

//function to run when plugin is activated
function run_at_deactivation(){
  $my_page = get_page_by_title( 'Angular page', OBJECT, 'page' );
  
  if($my_page -> ID) {
  	wp_delete_post($my_page -> ID);
  }
  	
  
}

register_activation_hook( __FILE__, 'run_at_activation' );

register_deactivation_hook( __FILE__, 'run_at_deactivation' );


