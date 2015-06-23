<?php
	use Avi\API;
	use Avi\Config;
	
	/**
	 * <h2>TelizeAPI Class</h2>
	 * <p>Extension of the API Class, responsible for providing an API interface for "Telize's JSON IP and GeoIP REST API" service.</p>
	 * 
	 * @author Avinash Rai
	 */
	class TelizeAPI extends API {
		
		
		/**
		 * <p<Creates an instance of TelizeAPI</p>
		 *
		 */
		public function __construct() {
			
			$this->_url = Config::get('api.telize.url');
		}
		
	}