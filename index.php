<?php

	// Start een sessie als er nog geen een aangemaakt is.
	if (session_status() !== PHP_SESSION_ACTIVE):
		session_start();
	endif;

	// Define standard sitelink met / erachter
	define("SITELINK", "http://localhost/wwi/");

	// Standard variables
	define("MINIMUM_STOCK", 10000);

	// Lancering webshop
	define("START_JAAR", 2020);
	define("START_MAAND", 05);
	define("START_DAG", 31);

	// Define standard maps
	define("IMAGES", SITELINK . "assets/images/");
	define("CSS", SITELINK . "/assets/css/");
	define("JAVASCRIPT", SITELINK . "/assets/javascript/");
	define("FONTS", SITELINK . "/assets/fonts/");

	// Template
	define("TEMPLATE", __DIR__ . "/template/");

	// Require database connectie
	require_once('includes/database.php');

	// Require functies
	require_once('includes/functions.php');

	// Inladen van de juiste header
	if (IsGebruikerIngelogd()):
		require_once('template/header/ingelogd.php');
	else:
		require_once('template/header/header.php');
	endif;

	// Routing om de juiste pagina te openen
	require_once('routes.php');

	// Inladen van de juiste footer
	if (IsGebruikerIngelogd()):
		require_once('template/footer/footer.php');
	else:
		require_once('template/footer/footer.php');
	endif;

	// Schalen van afbeelding
	//	https://blogs.oracle.com/oswald/scaling-images-in-php-done-right