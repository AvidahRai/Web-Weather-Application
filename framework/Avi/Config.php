<?php namespace Avi;

	/**
	 * <h2>Config Class</h2>
	 * <p>Responsible for providing an interface for the application's configuration settings.</p>
	 * 
	 * @namespace Avi
	 * @author Avinash Rai
	 * @static
	 */
	class Config { 
		
		
		/**
		 * <p>A hash map of all loaded configuration items</p>
		 * 
		 * @var array
		 * @access protected
		 * @static
		 */
		protected static $_items = [];
		
		
		/**
		 * <p>Gets the configuration setting of an item using a dot notation reference.</p>
		 * <p> E.g. get('application.name') etc. </p>
		 * 
		 * @param string $key
		 * @return mixed
		 * @access public
		 * @static
		 */
		public static function get($key) {
				
			static::_load();
			
			return Helper::getElementByKey(static::$_items, $key);
		}
		
		
		/**
		 * <p>Loads all of the configuration items from the application's configuration file.</p>
		 * 
		 * @param void
		 * @return void
		 * @access private
		 * @static
		 */
		private static function _load() {
				
			static::$_items = require path('application').'config.php';
		}
		
	}
