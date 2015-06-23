 <?php
	/*
	* Filename: system_paths.php
	* Author: Avinash Rai
	* Last Modified: 21/06/2015
	* Description: Specify the URI paths
	*/
 	
	define('DS', DIRECTORY_SEPARATOR);
	
	$directory_paths['application'] = 'application';
	
	$directory_paths['framework'] = 'framework';
	
	$directory_paths['public'] = 'public';
	
	$directory_paths['storage'] = 'storage';
	
	chdir(__DIR__);
	
	$GLOBALS['system_path']['base'] = __DIR__.DS;
	
	foreach ($directory_paths as $name => $path) {
		if ( ! isset($GLOBALS['system_path'][$name])) {
			$GLOBALS['system_path'][$name] = realpath($path).DS;
		}
	}
	
	function path($path) {
		return $GLOBALS['system_path'][$path];
	}
	
	function set_path($path, $value) {
		$GLOBALS['system_path'][$path] = $value;
	}	