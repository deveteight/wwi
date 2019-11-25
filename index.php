<?php

	// Start een sessie als er nog geen een aangemaakt is.
	if (session_status() !== PHP_SESSION_ACTIVE):
		session_start();
	endif;

	// Define standard sitelink
	define("SITELINK", "http://localhost/school/www/");

	// Standard variables
	define("MINIMUM_STOCK", 10000);

	// Lancering webshop
	define("START_JAAR", 2020);
	define("START_MAAND", 05);
	define("START_DAG", 31);

	// Define standard maps
	define("IMAGES", SITELINK . "images/");
	define("CSS", SITELINK . "/css/");
	define("JAVASCRIPT", SITELINK . "/javascript/");
	define("FONTS", SITELINK . "/fonts/");

	// Template
	define("TEMPLATE", __DIR__ . "/template/");

	// Require database connectie
	require_once('includes/database.php');

	// Require functies
	require_once('includes/functions.php');

	// Inladen van de header
	if (IsGebruikerIngelogd()):
		require_once('template/header/ingelogd.php');
	else:
		require_once('template/header/header.php');
	endif;

	// Routing om de juiste pagina te openen
	require_once('routes.php');

	// Inladen van de footer
	if (IsGebruikerIngelogd()):
		require_once('template/footer/footer.php');
	else:
		require_once('template/footer/footer.php');
	endif;

	// Schalen van afbeelding
	//	https://blogs.oracle.com/oswald/scaling-images-in-php-done-right