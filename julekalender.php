<?php
/*
Plugin Name: Christmas Advent Calendar
Plugin URI: http://advent-calendar.net
Description: Get a random selection of advent calendars from advent-calendar.net!
Version: 1.3
Author: Stian B Pedersen
Author URI: http://www.advent-calendar.net
*/
require("julekalender_plugin.php");
require("julekalender_widget.php");

function julekalender_setup() {
	new Julekalender;
}
add_action('admin_init', 'julekalender_setup');

function julekalender_register_widget() {
	Julekalender::register_widget();
}
add_action('widgets_init', 'julekalender_register_widget');	

register_deactivation_hook( __FILE__, array('Julekalender','julekalender_remove') );
?>