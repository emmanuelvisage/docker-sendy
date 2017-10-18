<?php 
	//----------------------------------------------------------------------------------//	
	//                               COMPULSORY SETTINGS
	//----------------------------------------------------------------------------------//
	
	/*  Set the URL to your Sendy installation (without the trailing slash) */
	define('APP_PATH', getenv('SENDY_PATH'));
	
	/*  MySQL database connection credentials (please place values between the apostrophes) */
	$dbHost = 'mysql'; //MySQL Hostname
	$dbUser = 'root'; //MySQL Username
	$dbPass = getenv('MYSQL_ROOT_PASSWORD'); //MySQL Password
	$dbName = getenv('MYSQL_DATABASE'); //MySQL Database Name

	$environment = getenv('SENDY_ENV');
	$testEmail = getenv('SENDY_LOCAL_EMAIL_TO');
	
	//----------------------------------------------------------------------------------//	
	//								  OPTIONAL SETTINGS
	//----------------------------------------------------------------------------------//	
	
	/* 
		Change the database character set to something that supports the language you'll
		be using. Example, set this to utf16 if you use Chinese or Vietnamese characters
	*/
	$charset = 'utf8mb4';
	
	/*  Set this if you use a non standard MySQL port.  */
	$dbPort = getenv('MYSQL_PORT');	
	
	/*  Domain of cookie (99.99% chance you don't need to edit this at all)  */
	define('COOKIE_DOMAIN', '');
	
	//----------------------------------------------------------------------------------//
?>