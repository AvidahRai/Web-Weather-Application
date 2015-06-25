# weather-appliction
Version: 1.0
Release: 23/06/2015

Weather Application is an one-page web application, developed and designed for displaying current and five-day-forecast weather data for a single location. This application uses two APIs :- <a href="http://openweathermap.org/api">OpenweatherMapAPI</a> and <a href="http://www.telize.com/">Telize GeoIP API</a>.

<h3>Feature</h3>

1. The application uses Telize GeoIP to find the user's location and calls the weather information from OpenWeatherMapAPI.
2. The user's can search for a location, by entering the location's name on the application's Autocomplete search feature. Selecting the location will display its weather information.

<h3>Setup Instructions</h3>

1. You will need to first get an Application Key from <a href="http://openweathermap.org/api">OpenWeatherMap.</a>. <br><strong>Note this is not a product placement scheme and there are other alternatives for this.</strong>
2. In the "application/config.php" file change the value 'APPID' => '', with the new accquired Application key.
3. Place all folders in a desired location and set the URL Pointer to the "public" making it the document root folder.
4. Run the application and enjoy.

<h3>Links</h3>

1. To view the working example visit the site: <a href="http://weather-application.avinashrai.com/">http://weather-application.avinashrai.com/</a>
