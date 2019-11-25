<?php

	/**
	 * @param $zoekwoord
	 * @return array
	 */
	function ZoekDoorProducten($zoekwoord){
		if (isset($zoekwoord)):
			$sql = "SELECT Stockgroupname, StockItemName, si.StockItemID, si.UnitPrice, si.Tags, sh.QuantityOnHand,
						( SELECT COUNT(si.StockItemID) FROM stockgroups sg
						  JOIN stockitemstockgroups sisg ON sg.StockGroupID = sisg.StockGroupID
						  JOIN stockitems si ON sisg.StockItemID = si.StockItemID
						  JOIN stockitemholdings sh ON sisg.StockItemID = sh.StockItemID 
						  WHERE StockItemName LIKE '%$zoekwoord%') as aantal
					FROM stockgroups sg
					JOIN stockitemstockgroups sisg ON sg.StockGroupID = sisg.StockGroupID
					JOIN stockitems si ON sisg.StockItemID = si.StockItemID
					JOIN stockitemholdings sh ON sisg.StockItemID = sh.StockItemID
					WHERE StockItemName LIKE '%$zoekwoord%';";
		else:
			header('Location: '. SITELINK .'zoeken');
		endif;

		return connectionDB()->query( $sql )->fetchAll(PDO::PARAM_STMT);
	}

	/**
	 * @return array
	 */
	function AlleProducten() {
		$query = "SELECT * FROM stockitems";
		return connectionDB()->query( $query )->fetchAll(PDO::FETCH_OBJ);
	}

	/**
	 * @param $productID
	 * @return mixed
	 */
	function ToonProduct($productID) {
		$query = "SELECT * 
				FROM stockitems s
				JOIN stockitemholdings sh ON s.StockItemID = sh.StockItemID
				WHERE s.StockItemID = $productID";
		 return connectionDB()->query( $query )->fetch(PDO::PARAM_STR);
	}

	/**
	 * @param $pagina
	 * @param $bericht
	 */
	function GaNaarPagina($pagina, $bericht = null) {
		header('Location: '. SITELINK . $pagina .'');
	}

	/**
	 * @return array
	 */
	function alleCategorieen(){
		$query = "SELECT Stockgroupname, StockGroupID FROM stockgroups ORDER BY StockGroupID";
		return connectionDB()->query( $query )->fetchAll(PDO::PARAM_STR);
	}

	/**
	 * @param $catID = Categorie ID
	 * @param null $begin = Begin plek ( (paginanummer - 1 ) * aantal producten geselecteerd per pagina)
	 * @param null $limiet = Aantal producten (geselecteerd in het filter)
	 * @return array
	 */
	function ToonCategorieProduct($catID, $begin = null, $limiet = null) {
		$sql = "	SELECT Stockgroupname, StockItemName, si.StockItemID, si.UnitPrice, si.Tags, sh.QuantityOnHand,
						( SELECT COUNT(si.StockItemID) FROM stockgroups sg
						  JOIN stockitemstockgroups sisg ON sg.StockGroupID = sisg.StockGroupID
						  JOIN stockitems si ON sisg.StockItemID = si.StockItemID
						  JOIN stockitemholdings sh ON sisg.StockItemID = sh.StockItemID 
						  WHERE sg.StockGroupID = :catid) as aantal
					FROM stockgroups sg
					JOIN stockitemstockgroups sisg ON sg.StockGroupID = sisg.StockGroupID
					JOIN stockitems si ON sisg.StockItemID = si.StockItemID
					JOIN stockitemholdings sh ON sisg.StockItemID = sh.StockItemID
					WHERE sg.StockGroupID = :catid
					LIMIT :start, :result";
		$query = connectionDB()->prepare ($sql);
		$query->bindParam(":catid", $catID, PDO::PARAM_INT);
		$query->bindParam(":start", $begin, PDO::PARAM_INT);
		$query->bindParam(":result", $limiet, PDO::PARAM_INT);
		$query->execute();
		return $query->fetchAll(PDO::PARAM_STMT);
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

	function ToonFormatenbijProduct($id) {
		// Selecteer huidig product zonder maat.
		$query = "SELECT StockItemName, Size FROM stockitems WHERE StockITEMID = $id";
		$x = connectionDB()->query( $query )->fetch(PDO::FETCH_OBJ);
		$zoekresultaat = str_replace($x->Size, "", $x->StockItemName);

		// Selecteer alle producten
		$query = "SELECT StockItemID, StockItemName, Size FROM stockitems WHERE StockItemName LIKE '$zoekresultaat%' ORDER BY StockItemID";
		return connectionDB()->query( $query )->fetchAll(PDO::FETCH_OBJ);
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