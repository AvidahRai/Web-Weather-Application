<?php namespace Avi; 
	
	/**
	 * <h2>BaseController Class</h2>
	 * <p>Provides a common interface for all "controllers" used in the application.</p>
	 * 
	 * @namespace Avi
	 * @author Avinash Rai
	 * @abstract
	 */
	abstract class BaseController {	
		
		
		/**
		 * <p>Returns an instance of a class, presumed to be a "model" class.</p>
		 * 
		 * @param string $model_name
		 * @param array $params
		 * @return object
		 * @access protected
		 */
		protected function model($model_name='', $params=[]) { 
			
			if ($model_name != '') {
				
				$fileURI = path('application').'models'.DS.$model_name.'.php';
				
				if ( file_exists($fileURI) ) {
					
					require_once($fileURI);
					
					if ( count($params) > 0 ) {
						
						return new $model_name($params);
					
					} else {
						
						return new $model_name;
					}
				}
			}
		}
		
		
		/**
		 * <p>Includes a file, presumed to a "view".</p>
		 * 
		 * @param string $view_name
		 * @param array $data
		 * @return void
		 * @access protected
		 */
		protected  function view($view_name='', $data=[]) {
			
			if ($view_name != '') {
				
				$fileURI = path('application').'views'.DS.$view_name.'.html';
				
				if ( file_exists($fileURI) ) {
					
					include_once($fileURI);
				}
			}
		}
		
	}