<?php namespace Avi;

	/**
	 * <h2>Helper Class</h2>
	 * <p>Provides useful general functions used throughout the application.</p>
	 * 
	 * @namespace Avi
	 * @author Avinash Rai
	 * @static
	 */
	class Helper {
		
		
		/**
		 * <p>Gets an item from an array using "dot" notation reference.</p>
		 * 
		 * @param array $array 
		 * @param string $index
		 * @param string $default
		 * @return mixed
		 * @access public
		 * @static
		 */
		public static function getElementbyKey(array $array, $key='', $default='') {
			
			if ( is_null($key) ) return $array;
			
			foreach ( explode('.', $key) as $segment ) {
				
				if ( !is_array($array) or ! array_key_exists($segment, $array) ) {
					
					return $default;
				}
			
				$array = $array[$segment];
			}
			
			return $array;
		}
		
	}
