<?php namespace Avi;
	
	/**
	 * <h2>Cacheable Interface</h2>
	 * <p>Classes that implements this interface will possess a "cacheable" behaviour.</p>
	 * 
	 * @namespace Avi
	 * @author Avinash Rai
	 */
	interface Cacheable { 
		
		
		/**
		 * <p>Determine if the cache has an item with the specified identifier.</p>
		 *
		 * @param mixed $identifier
		 * @access public
		 */
		public function isCached($identifier);
		
		
		/**
		 * <p>Returns the item from the cache using the identifier.</p>
		 *
		 * @param mixed $identifier
		 * @access public
		 */
		public function getCached($identifier);
		
		
		/**
		 * <p>Stores the data to the cache and sets a unique identifier to it.</p>
		 *
		 * @param mixed $identifer
		 * @param mixed $data
		 * @access public
		 */
		public function cache($identifer, $data);
		
	}