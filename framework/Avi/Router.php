<?php namespace Avi;
	
	/**
	 * <h2>Router Class</h2>
	 * <p>Responsible for a switching the application route.</p>
	 * 
	 * @namespace Avi
	 * @author Avinash Rai
	 * @static
	 */
	class Router { 
		
		
		/**
		 * <p>Name of the controller. Default "MainController".</p>
		 * 
		 * @var string
		 * @access protected
		 * @static
		 */
		protected static $_controller = 'MainController';
		
		/**
		 * <p>The name of the action. Default "main".</p>
		 *
		 * @var string
		 * @access protected
		 * @static
		 */		
		protected static $_action = 'main';
		
		/**
		 * <p>The extra parameters other than the controller and the action.</p>
		 *
		 * @var array
		 * @access protected
		 * @static
		 */		
		protected static $_parameters = [];
		
		
		/**
		 * <p>Sends a response by invoking the "controller" class and its "action" method along with optional parameters.</p>
		 * 
		 * @param void
		 * @return void
		 * @access public
		 * @static
		 */
		public static function forward() {
			
			$url = HttpRequest::parsedQuery();
			
			if ( isset($url[0]) ) {
			
				$url[0] = ucwords($url[0]);
				
				if ( file_exists(path('application').'controllers'.DS.$url[0].'.php') ) {
					
					static::$_controller = $url[0];
					
					unset($url[0]);
				}
			}
			
			require_once( path('application').'controllers'.DS.static::$_controller.'.php' );
			
			static::$_controller = new static::$_controller();
			
			if ( isset($url[1]) ) {
				
				$url[1] = strtolower($url[1]);
				
				if ( method_exists(static::$_controller, $url[1]) ) {

					static::$_action = $url[1];
					
					unset($url[1]);
				}		
			}
			
			static::$_parameters = $url ? array_values($url) : [];
			
			unset($url);
			
			call_user_func_array([static::$_controller, static::$_action], static::$_parameters);
		}
		
		
		/**
		 * <p>Redirects to the specified URL location.</p>
		 * 
		 * @param string $url_string
		 * @return void
		 * @access public
		 * @static
		 */
		public static function redirect($url_location) { 
			
			$url = Application::url().strtolower($url_location);
			
			header("Location: ".$url);
		}
		
		
		/**
		 * <p>Redirects to base URL location.</p>
		 * 
		 * @param void
		 * @return void
		 * @access public
		 * @static
		 */	
		public static function redirectToHome() {
			
			header("location:{Application::get('application.url')}");
		}
		
	}
	