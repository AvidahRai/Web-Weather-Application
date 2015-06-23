	/*
	 * Filename: events.js
	 * Author: Avinash Rai
	 * Last Modified: 21/06/2015
	 * Description: GUI Event Handlers.
	 */


	$( document ).ready(function() {
		
		/* Make an AJAX request with url "MainController/weatherdata". */
		var weather = new Ajax('GET', 'MainController/weatherData', '');
		weather.response('#main');
		delete weather;
		
		/* Autocomplete Search Functionality */
		$( "#search-bar" ).focus(function() {
			if ( $(this).val() == 'Search for a town/city by name' ) {
				$( "#search-bar" ).val('');
			}
		});
		
		$( "#search-bar" ).focusout(function() {
			if ( $(this).val() == '' ) {
				$( "#search-bar" ).val('Search for a town/city by name');
			}
		});
		
		/* Make an AJAX request with url "MainController/location/data". */
		$( "#search-bar" ).keyup(function() {
			var data = $(this).val().replace(/\s/g , "_");
			var location = new Ajax('GET', 'MainController/location', data);
			location.response('#search-results');
			delete location;
		});
		
		$( ":not(#search)" ).click(function() {
			$( "#search-results" ).html('');
		});
		
	});

	
	/* Make an AJAX request with url "MainController/weatherdata/id". */	
	function weatherBySelect(id) {
		var weather = new Ajax('GET', 'MainController/weatherData', id);
		weather.response('#main');
		delete weather;
		$( "#search-results" ).html('');
		$( "#search-bar" ).val('Search for a town/city by name');
	}