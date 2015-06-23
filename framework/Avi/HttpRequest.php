<?php namespace Avi;
	
	/**
	 * <h2>HttpRequest Class</h2>
	 * <p>Responsible for providing an interface for a single HTTP Request made by a client.</p>
	 * 
	 * @namespace Avi
	 * @author Avinash Rai
	 * @static
	 */
	class HttpRequest { 
		
		
		/**
		 * <p>Returns the query string used in the request</p>.
		 * 
		 * @param void
		 * @return string
		 * @access public
		 * @static
		 */
		public static function query() {
			
			return $_SERVER['QUERY_STRING'];
		}
		
		
		/**
		 * <p>Returns the components of the request url assigned to an array.</p>
		 * 
		 * @param void
		 * @return array
		 * @access public
		 * @static
		 */
		public static function parsedQuery() {
			
			if ( isset($_GET['query'])) {	
			 	
				return explode('/', filter_var(rtrim($_GET['query'], '/'), FILTER_SANITIZE_URL));
			}
		}
		
		
		/**
		 * <p>Returns the method of the request.</p>
		 * 
		 * @param void
		 * @return string
		 * @access public
		 * @static
		 */
		public static function method() {
			
			return $_SERVER['REQUEST_METHOD'];
		}
		
		
		/**
		 * <p>Returns the data sent along the request.</p>
		 * 
		 * @param void
		 * @return array
		 * @access public
		 * @static
		 */
		public static function data() {
			
			switch(static::method()) {
				
				case 'GET':
					return $_GET;
					break;
					
				case 'POST':
					return $_POST;
					break;
					
				default :
					return [];
					break;
			}
		}
		
		
		/**
		 * <p>Returns the UNIX timestamp for the time when the request was made.</p>
		 * 
		 * @param void
		 * @return integer
		 * @access public
		 * @static
		 */
		public static function time() {
				
			return $_SERVER['REQUEST_TIME'];
		}
		
			
		/**
		 * <p>Determine if the request was made using AJAX.</p>
		 * 
		 * @param void
		 * @return boolean
		 * @access public
		 * @static
		 */
		public static function isAjax() {
		
			return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ? true : false;		
		}
		
		
		/**
		 * <p>Returns the ip address of the requestor.</p>
		 * 
		 * @param void
		 * @return string
		 * @access public
		 * @static
		 */
		public static function ipAddress() {
			
			return $_SERVER['REMOTE_ADDR'];
		}
		
	}