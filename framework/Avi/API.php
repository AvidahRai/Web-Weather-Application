<?php namespace Avi; 	
	
	/**
	 * <h2>API Class</h2>
	 * <p>An abstract class for providing basic structure and functionality expected for an API.</p>
	 * 
	 * @namespace Avi
	 * @author Avinash Rai
	 * @abstract
	 * 
	 */
	abstract class API { 
		
		
		/**
		 * <p>The url path of the REST API.</p>
		 * 
		 * @var string
		 * @access protected
		 */
		protected $_url = ''; 

		/**
		 * <p>The keys (application keys, access token etc.) required for authenticating to the API.</p>
		 *
		 * @var string
		 * @access protected
		 */		
		protected $_apiKeys = []; 
		
		/**
		 * <p>The hash map of decoded data recieved from the API.</p>
		 *
		 * @var string
		 * @access protected
		 */		
		protected $_properties = [];
		
		/**
		 * <p>The location for storing the API response.</p>
		 *
		 * @var mixed
		 * @access protected
		 */		
		protected $_cache = null;
		
		
		/**
		 * <p>Gets an item of the properties using a dot notation reference.</p>
		 * <p>E.g. API::get('api.service.name'); </p>
		 *
 		 * @param string $key
		 * @return mixed
		 * @access public
		 */
		public function get($key) {
		
			return Helper::getElementbyKey($this->_properties, $key);
		}

		
		/**
		 * <p>Makes a call to the API. The call may include additional request paramaters.</p>
		 *
		 * @param array $params
		 * @return void
		 * @access public
		 */
		public function requestData($params=[]) {	

			if ($this->cacheable() && $this->isCached($params)) { 
				
				$this->_properties = json_decode($this->getCached($params), true);
				
				return;
				
			} else { 
				
				$full_url = $this->buildRequest($params);
				
				$json_data = $this->sendRequest($full_url);	
				
				$this->_properties = json_decode($json_data, true);
				
				if ($this->cacheable()) { 
					
					$identifier = $params;
					
					$this->cache($identifier, $json_data);
				}
				
				unset($identifier, $full_url, $json_data);
				
				return;
			}
		}

		
		/**
		 * <p>Deteremine if the API has a cacheable behaviour.</p>
		 *
		 * @param void
		 * @return boolean
		 * @access public
		 */
		public function cacheable() {
		
			return ($this instanceof Cacheable) ? true : false;
		}		
		
		
		/**
		 * <p>Builds the HTTP query string. The query string may merge additional paramters.</p>
		 *
		 * @param array $params
		 * @return string
		 * @access protected
		 */
		protected function buildRequest($params=[]) { 
					
			if ( count($this->_apiKeys) > 0 ) {
		
				$params = array_merge($params, $this->_apiKeys);
			}
			
			if ( is_array($params)) {
				$query_string = http_build_query($params);
			} else {
				$query_string = $params;
			}
			
			return sprintf($this->_url, $query_string);
		}
		
		
		/**
		 * <p>Makes a call to the specified API using PHP curl.</p>
		 *
		 * @param string $full_url
		 * @return mixed
		 * @access protected
		 */
		protected function sendRequest($full_url) {
				
			 $curl = curl_init($full_url);
			 	
			 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			 	
			 curl_setopt($curl, CURLOPT_URL, $full_url);
			 	
			 $data = curl_exec($curl);
		
			 curl_close($curl);
			
			 return $data;
		}
			
	}