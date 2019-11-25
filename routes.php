<?php

	$_GET['page'] = (!isset($_GET['page']) ? "" : $_GET['page']);

switch ($_GET['page']):
	case '/' :
		require __DIR__ . '/views/home.php';
		break;
	case '' :
		require __DIR__ . '/views/home.php';
		break;
	case 'home' :
		require __DIR__ . '/views/home.php';
		break;
	case 'product' :
		require __DIR__ . '/views/product.php';
		break;
	case 'zoeken' :
		require __DIR__ . '/views/zoeken.php';
		break;
	case 'about' :
		require __DIR__ . '/views/about.php';
		break;
	case 'about' :
		require __DIR__ . '/views/about.php';
		break;
	case 'inloggen' :
		require __DIR__ . '/views/inloggen.php';
		break;
	case 'winkelwagen' :
		require __DIR__ . '/views/winkelwagen.php';
		break;
	case 'verlanglijst' :
		require __DIR__ . '/views/verlanglijstje.php';
		break;

	// ALLEEN ALS DE GEBRUIKER IS INGELOGD
	case 'profiel' :
		if (IsGebruikerIngelogd()):
			require __DIR__ . '/views/ingelogd/profiel.php';
		else:
			require __DIR__ . '/views/home.php';
		endif;
		break;

	case 'beheer':
		if (IsGebruikerIngelogd()):
			require __DIR__ . '/views/ingelogd/beheer.php';
		else:
			require __DIR__ . '/views/home.php';
		endif;
		break;

	case 'uitloggen' :
		if (IsGebruikerIngelogd()):
			require __DIR__ . '/views/uitloggen.php';
		else:
			require __DIR__ . '/views/home.php';
		endif;
		break;

	// STANDAARD 404 TONEN ALS ER GEEN PAGINA KAN WORDEN GEVONDEN
	default:
		http_response_code(404);
		require __DIR__ . '/views/404.php';
		break;
endswitch;

// If sessie + ingelogd
// /profiel
// /uitloggen
// /afrekenen
// /verlanglijstje