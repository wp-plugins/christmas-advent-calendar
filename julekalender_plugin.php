<?php
class Julekalender {
	public $options;

	/* Init plugin, register settings, register script & css, call api function */
	public function __construct() {
		$this->julekalender_loadTextDomain();
		$this->options = get_option('julekalender_plugin_options');
	}

	public function julekalender_remove() {
		delete_option("julekalender_plugin_options");
	}

	public function julekalender_loadTextDomain() {
		//echo plugin_dir_url(plugin_basename( __FILE__ ) . '/languages');
		$path = basename(dirname( __FILE__ )) . '/languages/';
		load_plugin_textdomain('julekalender', false, $path );
	}

	public function register_widget() {
		register_widget("JulekalenderWidget");	
	}
}