
<h2>Winkelwagen</h2>
<?php
//$_SESSION['winkelwagen'] = [ "123" => "1"	];
//	http://localhost/school/www/winkelwagen/100/del/10
//	http://localhost/school/www/winkelwagen/100/add/10

// Session unix() + 3600 seconden
// Tweede $_SESSION[''] aanmaken met tijdstip aanmaken van de array, dit vergelijken met huidig tijdstip.
// Als dit overeenkomt dan $_SESSION['winkelwagen'] weghalen met unset();

// Bekijk of $_SESSION['winkelwagen'] bestaat
if (!isset($_SESSION['winkelwagen'])):
	$_SESSION['winkelwagen'] = [];
endif;

// Bekijk of er een actie gaande is met add
if (isset($_GET['actie']) && $_GET['actie'] == "add"):
	print_r($_SESSION['winkelwagen']);
	$_SESSION['winkelwagen'][$_GET['id']] = $_GET['aantal'];
//    GaNaarPagina('product/' . $_GET['id'], "Toegevoegd aan winkelmandje");
endif;

// Bekijk of er een actie gaande is met del
if (isset($_GET['actie']) && $_GET['actie'] == "del"):
	unset($_SESSION['winkelwagen'][$_GET['id']]);
	GaNaarPagina('winkelwagen');
endif;

// Tel alle producten in de winkelwagen en toon dit op het scherm
if (count($_SESSION['winkelwagen']) > 0):
	?>
	<div class="row">
	<?php
	foreach ($_SESSION['winkelwagen'] as $value => $item):
		$x = ToonProduct($value);
	?>
        <div class="card" style="width: 18rem;">
            <img style="max-width: 50px;" src="<?php echo !empty($x['Photo']) ? $x['Photo'] : IMAGES . 'placeholder_150.png' ?>" alt="<?php echo !empty($x['Photo']) ? 'Afbeeldingen voor ' . $x['StockItemName'] : 'Placeholder afbeelding' ?>" title="<?php echo !empty($x['Photo']) ? 'Afbeeldingen voor ' . $x['StockItemName'] : 'Placeholder afbeelding' ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?php echo $x['StockItemName']; ?></h5>
                <p>SKU: <?php echo $x['StockItemID'] ?></p>
                <p class="card-text">&euro;<?php echo $x['UnitPrice']?></p>
                <p class="card-text">Aantal: <?php echo $item ?> stuks</p>
                <a href="<?php echo SITELINK ."winkelwagen/". $x['StockItemID'] ."/add/" . $item = $item + 1 ?>" class="btn btn-success"><i class="fa fa-shopping-basket"></i></a>
                <a href="<?php echo SITELINK ."winkelwagen/". $x['StockItemID'] ."/del/1" ?>" class="btn btn-danger"><i class="fa fa-shopping-basket"></i></a>
            </div>
        </div>
	<?php
	endforeach;
    ?>
	</div>
<?php
endif;

//	 1. Kijken of een sessie is gestart
//	 2. Check of de sessie $_SESSION['winkelwagen'] is gestart (zo ja, stap 4, zo niet, stap 3)
//	 3. Aanmaken $_SESSION['winkelwagen'] = []; = ARRAY
//	 4. Foreach om door de producten heen te gaan

// ARRAY MET KEY => VALUE
// ARRAY MAG NIET DUBBELE KEY HEBBEN, ANDERS MOET JE DE AANTALLEN BIJ ELKAAR OPTELLEN
// $_SESSION['winkelwagen'] = [	"PRODUCT_ID" => "AANTAL",
	// 							"PRODUCT_ID" => "AANTAL",
	//							"PRODUCT_ID" => "AANTAL",
	//							"PRODUCT_ID" => "AANTAL"]
