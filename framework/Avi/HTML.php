<?php namespace Avi;
		
	/**
	 * <h2>HTML Class</h2>
	 * <p>Responsible for providing functionalities used in HTML implementation</p>
	 * 
	 * @namespace Avi
	 * @author Avinash Rai
	 * @static
	 */
	class HTML {
		
		
		/**
		 * <p>Generates and returns an absolute url path and reference to/on public directory.</p>
		 * 
		 * @param string $url
		 * @return string
		 * @access public
		 * @static
		 */
		public static function url($url) {
			
			return Application::url().$url;
		}
		
	}