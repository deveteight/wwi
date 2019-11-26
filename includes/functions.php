<?php

	/**
	 * @param $pagina
	 * @param $bericht
	 */
	function GaNaarPagina($pagina, $bericht = null) {
		header('Location: '. SITELINK . $pagina .'');
	}

	function clean($string) {
		$string = str_replace(' ', '-', $string);
		$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);

		return preg_replace('/-+/', '-', $string);
	}

	function cleanLi($string) {
		$string = preg_replace('/[^A-Za-z0-9\-]/', ' ', $string);

		return preg_replace('/-+/', '-', $string);
	}

	function DollarToEuro($bedrag) {
		return  str_replace(".", ",", sprintf("%.2f",round($bedrag * 0.904, 2)));
	}

	function IsGebruikerIngelogd() {

		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true):
			return true;
		endif;

		return false;
	}

	function LinkNaarPagina($pagina = null) {

		if (isset($pagina)):
			echo SITELINK . "$pagina";
		else:
			echo SITELINK;
		endif;
	}

	# TODO Moet nog worden afgemaakt.
	function LaadTemplateIn($Pagina) {
		if (isset($Pagina)):
			include_once( TEMPLATE . $Pagina . ".php");
		endif;
	}