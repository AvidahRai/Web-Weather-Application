	/*
	 * Filename: Classes.js
	 * Author: Avinash Rai
	 * Last Modified: 21/06/2015
	 * Description: Defines Javascript Classes.
	 */	

	/*
	 * <h2>Ajax Class</h2>
	 * <p>Responsible for providing application specific-AJAX functionilty</p>
	 * 
	 * @author Avinash Rai
	 */
	function Ajax (method, controller, data) {
		
		
		this.method = method;
		
		this.controller = controller; 
		
		this.data = data;
		
		
		/*
		 * <p>Renders the response from the AJAX request on the specified elementId.</p>
		 * 
		 * @param string elementId
		 * @return boolean
		 */
		this.response = function(elementId) {
			this.refine();
			$.ajax({
		    	url: this.controller,
		    	method: this.method,
		    	data: this.data,
		    	statusCode : { 
		    		102 : function() { 
		    			$(elementId).html('<img id="loader" src="images/loader.gif">');
		    		}, 
		    		200 : function(result) {
		    			$(elementId).html(result);
		    		}
		    	}
		    });
		}
		
		
		/*
		 * <p>Refine the AJAX request paramters based on the request method used.</p>
		 * 
		 * @param void
		 * @return void
		 */
		this.refine = function() {
			if (this.method == 'GET') {
				this.controller = this.controller + "/" + this.data;
				this.data = null;
			}
		}
		
		
	}