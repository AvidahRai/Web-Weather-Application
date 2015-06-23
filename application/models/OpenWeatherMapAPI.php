<?php
	use Avi\API;
	use Avi\Config;
	use Avi\Cacheable;
	
	/**
	 * <h2>OpenWeatherMapAPI Class.</h2>
	 * <p>Extension of OpenWeatherMapAPI, responsible for providing an API interface for "OpenWeatherMap API" service.</p>
	 * 
	 * @author Avinash Rai
	 */
	class OpenWeatherMapAPI extends API implements Cacheable {

		
		/**
		 * <p>Creates an instance of OpenWeatherMapAPI.</p>
		 *
		 */
		public function __construct() {
			
			$this->_apiKeys =  Config::get('api.openweathermap.keys');
		}
		
		
		/**
		 * <p>Makes a call to "OpenWeatherMapAPI" for retrieving Current Weather data using additional parameters</p>
		 * 
		 * @param array $params
		 * @return void
		 * @access public 
		 */
		public function requestCurrent($params=[]) {
			
			$this->_url = Config::get('api.openweathermap.current.url');
			
			$this->_cache = Config::get('api.openweathermap.current.cache');
			
			$this->requestData($params);
		}
		
		
		/**
		 * <p>Makes a call to "OpenWeatherMapAPI" for retrieving six Daily Weather Forecast for six days using additional parameters.</p>
		 *
		 * @param array $params
		 * @return void
		 * @access public
		 */		
		public function requestForecast($params=[]) {
			
			$this->_url = Config::get('api.openweathermap.forecast.url');
			
			$this->_cache = Config::get('api.openweathermap.forecast.cache');
			
			$this->requestData($params);
		}
		
		
		/**
		 * @see \Avi\Cacheable::isCached()
		 */
		public function isCached($identifier) { 
			
			$id_uri_pointer =  $this->_cache.DS.implode('-', $identifier).".json";
			
			return ( file_exists($id_uri_pointer) ) ? true : false;	
		}
		
		
		/**
		 * @see \Avi\Cacheable::getCached()
		 */
		public function getCached($identifier) {
			
			$id_uri_pointer =  $this->_cache.DS.implode('-', $identifier).".json";
			
			return file_get_contents($id_uri_pointer);
		}
		
		
		/** 
		 * @see \Avi\Cacheable::cache()
		 */
		public function cache($identifier, $data) {

			$id_uri_pointer =  $this->_cache.DS.implode('-', $identifier).".json";
			
			$dir_name = dirname($id_uri_pointer);
			
			if (!is_dir($dir_name)) {
				
				mkdir($dir_name, 0755, true);
			}
			
			$fp = fopen($id_uri_pointer, 'w');
			
			fwrite($fp, $data);
			
			fclose($fp);
			
			unset($id_uri_pointer, $dir_name, $data);
			
			return;
		}
		
		
		/**
		 * <p>Returns the mapped cardinal direction value of a specified degree value.</p>
		 *
		 * @param real $degrees
		 * @return string
		 * @access public
		 */
		public function cardinalDirection($degrees=0.0) {
				
			switch ($degrees) {
		
				case $degrees > 0 && $degrees < 22.5:
					return 'N';
					break;
		
				case $degrees > 22.5 && $degrees < 67.5:
					return 'NE';
					break;
		
				case $degrees > 67.5 && $degrees < 112.5:
					return 'E';
					break;
		
				case $degrees > 112.5 && $degrees < 157.5:
					return 'SE';
					break;
		
				case $degrees > 157.5 && $degrees < 202.5:
					return 'S';
					break;
		
				case $degrees > 202.5 && $degrees < 247.5:
					return 'SW';
					break;
		
				case $degrees > 247.5 && $degrees < 292.5:
					return 'W';
					break;
		
				case $degrees > 292.5 && $degrees < 337.5:
					return 'NW';
					break;
		
				case ($degrees > 337.5 && $degrees <= 360):
					return 'N';
					break;
			}
		}
		
	}