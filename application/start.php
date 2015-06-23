<?php
	/*
	 * Filename: start.php
	 * Author: Avinash Rai
	 * Last Modified: 21/06/2015
	 * Description: Bootstrap File
	 */	
 
	/*
	 * Register Autoloaders
	 */
	require path('framework').'Avi/Autoloader.php';
	spl_autoload_register(['Avi\Autoloader', 'load']);
	
	/*
	 * Error Reporting
	 */
	ini_set('display_errors', Avi\Application::debug());
	error_reporting(E_ALL);
	
	/*
	 * Start Application
	 */
	Avi\Application::start();