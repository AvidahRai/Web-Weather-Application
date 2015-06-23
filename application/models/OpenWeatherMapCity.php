<?php
	use Avi\Config;

	/**
	 * <h2>The OpenWeatherMapCity Class</h2>
	 * <p> Responsible for providing search and retrieve functionality on the OpenWeatherMap's city list data source.
	 * 
	 * @author Avinash Rai
	 */
	class OpenWeatherMapCity {
		
		
		/**
		 * <p>The OpenWeatherMap's data source. </p>
		 * 
		 * @var mixed
		 * @access private
		 */
		private $_source = null;
		
		/**
		 * <p>The list of results obtained after the search.</p>
		 * 
		 * @var array
		 * @access private
		 */
		private $_results = [];
		
		
		/**
		 * <p>Creates an instance of OpenWeatherMapCity.</p>
		 *
		 */
		function __construct() {
			
			$filePath = Config::get('storage.openweathermapcity.uri');
			
			if ( 
				is_file($filePath) &&
				pathinfo($filePath, PATHINFO_EXTENSION) == 'txt' &&
				is_readable($filePath)
			) {
				$this->_source = $filePath;
			}
		}

		
		/**
		 * <p>Searches the query on the source using regular expression and stores the matches as results.</p>
		 *
		 * @param string $query
		 * @param integer $result_limit
		 * @return void
		 * @access public
		 */
		public function search($query, $result_limit) {
			
			$contents = file_get_contents($this->_source);
			
			$pattern = preg_quote($query, '/');
			
			$pattern = "/^.*$pattern.*$/mi";

			if ( preg_match_all($pattern, $contents, $matches, PREG_PATTERN_ORDER) ) {

				$this->_results = $this->_parseResults($matches[0], $result_limit);
				
				unset($contents, $pattern, $matches);
				
			} else {
			
				$this->_results = [];
			}
		}
		
		
		/**
		 * <p>Returns the list of results.</p>
		 *
		 * @param void
		 * @return array
		 * @access public
		 */
		public function getResults() {
			 
			return $this->_results;
		}
				
		
		/**
		 * <p>Determine the availibity of the Data Source for this instance.</p>
		 *
		 * @param null
		 * @return boolean
		 * @access Public
		 */
		public function hasSource() {
				
			return ( isset($this->_source) ) ? true : false;
		}

		
		/**
		 * <p>Returns the array of results containing limited number of results, assigned with indicies.</p>
		 *
		 * @param array $results
		 * @param integer $limit
		 * @return array
		 * @access private
		 */		
		private function _parseResults(array $results, $limit=20) {
			
			$counter = ($limit > count($results)) ? count($results) : $limit;
			
			$array = [];
			
			for ($i=0; $i < $counter; $i++) {
				
				$array[] = array_combine( ['id', 'name', 'lat', 'long', 'country'], explode('	', $results[$i]) );
			}
			
			return $array;
		}

	}