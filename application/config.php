<?php
	/*
	 * Filename: config.php
	 * Author: Avinash Rai
	 * Last Modified: 21/06/2015
	 * Description: The Configuration settings.
	 */

	return [
		
		/*
		 * Application Settings
		 */
		'application' => [
			'name' => 'Weather Application',
			'version' => '1.0',
			'developer' => 'Avinash Rai',
			'url' => ' ',
			'encoding' => 'utf-8',
			'time_zone' => 'GMT'
		],
			
		/*
		 * Storage
		 */
		'storage' => [
			'openweathermapcity' => [
				'driver' => 'txt',
				'name' => 'city_list',
				'vendor' => 'openweathermap',
				'uri' => path('storage').'open-weather-map'.DS.'city'.DS.'city_list.txt',
				'last_updated' => '2015-06-21'
			]	
		],

		/*
		 * External API
		 */
		'api'=> [
			'telize' => [
				'url' => 'http://www.telize.com/geoip/%s'
			], 
			'openweathermap' => [
				'current' => [
					'url' => 'api.openweathermap.org/data/2.5/weather?lang=en&units=metric&%s',
					'cache' => path('storage').'open-weather-map'.DS.'weather'.DS.date('Y-m-d').DS.'current'.DS
				],
				'forecast' => [
					'url' => 'api.openweathermap.org/data/2.5/forecast/daily?lang=en&units=metric&cnt=6&%s',
					'cache' => path('storage').'open-weather-map'.DS.'weather'.DS.date('Y-m-d').DS.'forecast'.DS
				],
				'keys' => [
					'APPID' => 'PLEASE GET AN APPLICATION KEY FROM http://openweathermap.org/'
				]
			]
		],
			
		/*
		 * Session Settings
		 */
		'session' => [
				'table' => 'session',
				'lifetime' => '60',
				'cookie' => 'rairays_cookie'
		]
	];