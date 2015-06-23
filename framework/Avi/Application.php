<?php namespace Avi;
 	
	/**
	 * <h2>Application Class</h2>
	 * <p>Responsible for providing application specific functionalities.</p>
	 * 
	 * @namespace Avi
	 * @author Avinash Rai
	 * @static
	 */
	class Application { 
		
		
		/**
		 * <p>Finds whether this application is running locally or on a live environment.</p>
		 * 
		 * @param void
		 * @return string
		 * @access public
		 * @static
		 */
		public static function environment() {
			
			$host = substr($_SERVER['HTTP_HOST'], 0, 5);
			
			if (in_array($host, array('local', '127.0', '192.1'))) {
				
				return 'local';
				
			} else {
				
				return 'live';
			}		
		}
		
		
		/**
		 *<p>Determine if the application is debuggable. </p>
		 * 
		 * @param void
		 * @return boolean
		 * @access public
		 * @static
		 */
		public static function debug() {
			
			return (static::environment() == 'local') ? true : false;
		}
		
		
		/**
		 * <p>Returns the home url of the application.</p>
		 *
		 * @param void
		 * @return string
		 * @access public
		 * @static
		 */
		public static function url() {
				
			return Config::get('application.url');
		}
		
		
		/**
		 * <p>Returns the application encoding format.</p>
		 * 
		 * @param void
		 * @return string
		 * @access public
		 * @static
		 */
		public static function encoding() {
			
			return Config::get('application.encoding');
		}
		
		
		/**
		 * <p>Runs the application.</p>
		 * 
		 * @param void
		 * @return void
		 * @access public
		 * @static
		 */
		public static function start() { 
			
			Router::forward();
		}
	}
