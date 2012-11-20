<?php
/*
Plugin Name: Christmas Advent Calendar
Plugin URI: http://www.julekalender.com
Description: Get all Christmas Advent Calendars from julekalender.com. Give your users an opportunity to participate in competitions and win prices!
Version: 1.2.1
Author: Stian B Pedersen
Author URI: http://www.julekalender.com
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