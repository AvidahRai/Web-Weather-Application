<?php namespace Avi; 

	/**
	 * <h2> Autoloader Class </h2>
	 * 
	 * @namespace Avi
	 * @author Avinash Rai
	 * @static
	 */
	class Autoloader {
		
		
		/**
		 * <p>Used in php's spl_autoload_register() function.</p>
		 * 
		 * @param string $class 
		 * @return void
		 * @access public
		 * @static
		 */
		public static function load($class) {
			
			if ( !class_exists($class) ) { 
				
				$file = str_replace(['\\', '_'], '/', $class);
				
				$path = path('framework').$file.'.php';
				
				if ( file_exists($path) ) {
					
					require_once $path;
				}
			}
			
			return;
		}
	
	}	
