<?php
 	
	use Avi\BaseController;
	use Avi\Router;
	use Avi\HttpRequest as Request;
	use Avi\Config;
	
	/**
	 * <h2>Main Controller</h2>
	 * <p>The main controller of the application</p>
	 * 
	 * @author Avinash Rai
	 */
	class MainController extends BaseController { 

		
		/**
		 * <p>Action: "Maincontroller/main"</p>
		 * 
		 * @param void
		 * @return void
		 * @access public
		 */
		public function main() {
					
			parent::view('main');
		}
		
		
		/**
		 * <p>Action: "Maincontroller/weatherdata"</p>
		 * 
		 * @param string $id
		 * @return void
		 * @access public
		 */
		public function weatherdata($id=null) {
			
			if ( !Request::isAjax() ) {
				
				Router::redirectToHome();
			} 
			
			if ( ($id != null) ) {
				
				$parameters['id'] = $id;
				
			} else {
				
				$telizeAPIModel = parent::model('TelizeAPI');
					
				$telizeAPIModel->requestData(Request::ipAddress());
					
				$parameters['lat'] = $telizeAPIModel->get('latitude');
					
				$parameters['lon'] = $telizeAPIModel->get('longitude');
				
				unset($telizeAPIModel);
			}
			
			$openWeatherMapAPIModel = parent::model('OpenWeatherMapAPI');
				
			$openWeatherMapAPIModel->requestCurrent($parameters);
				
			parent::view('components/current-weather', $openWeatherMapAPIModel);
			
			unset($openWeatherMapAPIModel);
			
			$openWeatherMapAPIModel = parent::model('OpenWeatherMapAPI');
			
			$openWeatherMapAPIModel->requestForecast($parameters);
				
			parent::view('components/five-day-forecast', $openWeatherMapAPIModel);
				
			unset ($openWeatherMapAPIModel, $parameters);
		}

		
		/**
		 * <p>Action: "MainController/location"</p>
		 * 
		 * @param string $query
		 * @return void
		 * @access public
		 */
		public function location($query='') {
	
			if ( !Request::isAjax() ) {
				
				Router::redirectToHome();
			}
			
			if ( strlen($query) > 2 && preg_match('/^[A-z]+$/', $query)) {
					
				$file_path = Config::get('storage.openweathermapcity.uri');
				
				$openWeatherMapCity = parent::model('OpenWeatherMapCity', $file_path);
				
			 	$query = str_replace('_', ' ', $query);
				
				$openWeatherMapCity->search($query, 21);
								
				parent::view('components/search-results', $openWeatherMapCity->getResults() );
				
				unset($openWeatherMapCity, $file_path);
			}
		}
		
	}