
<!--<ul class="breadcrumb">-->
<!--    <li>-->
<!--        <a href="--><?php //echo SITELINK ?><!--" alt="Ga naar Home" title="Ga naar Home">Worldwideimport.nl</a>-->
<!--    </li>-->
<!--    <li>-->
<!--        <a href="--><?php //echo SITELINK ?><!--" alt="Ga naar ..." title="Ga naar ...">Producten</a>-->
<!--    </li>-->
<!--    <li>-->
<!--        <a href="--><?php //echo SITELINK ?><!--" alt="Ga naar ..." title="Ga naar ...">USB Novelties</a>-->
<!--    </li>-->
<!--    <li>-->
<!--        <a href="--><?php //echo SITELINK ?><!--" alt="Ga naar ..." title="Ga naar ...">USB Missile Launcher (Green)</a>-->
<!--    </li>-->
<!--</ul>-->

<?php

// Numeric > product ophalen
// Text > categorie ophalen
// Else > Homepagina

// Als er niks is ingevuld laat alle producten zien.

// Maten selector bij kleding of andere spullen met een andere kleur

if(!isset($_GET['id']) || !is_numeric($_GET['id']) ):
    #TODO Instellen dat je alle producten ziet met een limiet van 25 per pagina.
    GaNaarPagina("");
endif;

if(isset($_GET['cat'])):

	if (!isset($_GET['filter'])):
        $_GET['filter'] = "aantal:25";
	    $_GET['paginanummer'] = 1;
    endif;

    if (isset($_GET['filter'])):
        $aantal = 0;
		$filterArray = [];
		$filter = explode(",", $_GET['filter']);
		foreach ($filter as $value):
			array_push($filterArray, explode(":", $value));
		endforeach;
		foreach ($filterArray as $value):
			if ($value[0] == "aantal"):
                $start = $value[1] * ( (!empty($_GET['paginanummer']) ? $_GET['paginanummer'] : 1) - 1);
				$Producten = ToonCategorieProduct($_GET['id'], filter_var($start, FILTER_VALIDATE_INT), filter_var($value[1], FILTER_VALIDATE_INT));
				$aantal = $value[1];
			endif;
		endforeach;
    endif;

//    https://www.coolblue.nl/laptops/schermdiagonaal:0.3048-0.32766,0.381-0.40386/processor:amd-ryzen-5

	$aantalProducten = !empty($Producten[0]['aantal']) ? $Producten[0]['aantal'] : 0;
?>
	<div class="row">
        <div class="col-lg-2">

        </div>
        <div class="col-lg-10">
            <div class="filter-tab">
                <div class="filteraantal">
                    <h2><?php echo !empty($Producten[0]['Stockgroupname']) ? $Producten[0]['Stockgroupname'] : "" ?></h2>
                </div>
                <div class="filteraantal">
                    <span class="resultaten"><?php echo $aantalProducten; ?></span> resultaten |
                    <label for="filteraantal">Aantal: </label>
                    <select data-select-aantal id="filteraantal">
                        <option value="aantal:10" <?php echo (isset($_GET['filter']) && $_GET['filter'] == "aantal:10") ? "selected" : "" ?>>10 producten</option>
                        <option value="aantal:25" <?php echo (isset($_GET['filter']) && $_GET['filter'] == "aantal:25") ? "selected" : "" ?>>25 producten</option>
                        <option value="aantal:50" <?php echo (isset($_GET['filter']) && $_GET['filter'] == "aantal:50") ? "selected" : "" ?>>50 producten</option>
                        <option value="aantal:100" <?php echo (isset($_GET['filter']) && $_GET['filter'] == "aantal:100") ? "selected" : "" ?>>100 producten</option>
                    </select>
                    <!--                    <label for="resultaten"> Sorteren op: </label>-->
                    <!--                    <select id="resultaten">-->
                    <!--                        <option value="aantal:5"> Relevantie</option>-->
                    <!--                        <option value="aantal:10"> Prijs laag - hoog</option>-->
                    <!--                        <option value="aantal:25"> Prijs hoog - laag</option>-->
                    <!--                        <option value="aantal:50"> Best verkocht</option>-->
                    <!--                        <option value="aantal:100"> Best beoordeeld</option>-->
                    <!--                    </select>-->
                </div>
            </div>
            <div class="row d-flex justify-content-between" style="max-width: 1000px"><?php
            foreach ($Producten as $value):
                $tags = explode(",", $value['Tags']); ?>
                <div class="card col-lg-4" style="max-width: 300px; margin-bottom: 35px">
                    <a href="<?php echo SITELINK ."product/". $value['StockItemID']."/". strtolower(clean($value['StockItemName'])) ?>"
                       class="product-ahref"><img src="<?php echo !empty($value['Photo']) ? $value['Photo'] : IMAGES . 'placeholder_150.png' ?>"
                                                  alt="<?php echo !empty($value['Photo']) ? 'Afbeeldingen voor ' . $value['StockItemName'] : 'Placeholder afbeelding' ?>"
                                                  title="<?php echo !empty($value['Photo']) ? 'Afbeeldingen voor ' . $value['StockItemName'] : 'Placeholder afbeelding' ?>"
                                                  class="card-img-top"
                                                  alt="..."></a>
                    <div class="card-body">
                        <a href="<?php echo SITELINK ."product/". $value['StockItemID']."/". strtolower(clean($value['StockItemName'])) ?>"><h5 class="card-title"><?php echo $value['StockItemName']; ?></h5></a>
                        <ul><?php
                            foreach ($tags as $tag):
                                $tag = str_replace("[]", "", $tag);
                                if (!empty($tag)):  ?>
                                    <li class="usp-product"><?php echo Cleanli($tag); ?></li><?php
                                endif;
                            endforeach; ?>
                        </ul>
                        <?php if($value['QuantityOnHand'] >= MINIMUM_STOCK): ?>
                            <p style="font-size: 0.9rem"><i class="fa fa-check-circle" style="color: rgb(37, 156, 65)"></i> Op voorraad</p>
                        <?php else: ?>
                            <p style="font-size: 0.9rem"><i class="fa fa-times-circle" style="color: rgb(158, 27, 40)"></i> Niet op voorraad</p>
                        <?php endif; ?>
                        <div class="sorteer">
                            <p style="font-weight: bold; font-size: 1.15rem">&euro;<?php echo DollarToEuro($value['UnitPrice']); ?></p>
                            <?php if($value['QuantityOnHand'] >= MINIMUM_STOCK): ?>
                                <a href="<?php echo SITELINK ."winkelwagen/". $value['StockItemID']."/add/1" ?>" class="btn btn-success" title="Voeg toe aan winkelmandje"><i class="fa fa-shopping-basket"></i></a>
                            <?php elseif(IsGebruikerIngelogd()): ?>
                                <a href="<?php echo SITELINK ."verlanglijst/". $value['StockItemID']."/add/1" ?>" class="btn btn-link verlanglijst-knop" title="Voeg toe aan verlanglijstje"><i class="fa fa-heart"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div><?php
            endforeach; ?>
            </div>
        </div>
    </div><?php

    if (!empty($_GET['filter'])): ?>
    <div class="section">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
				<?php for ($x = 1; $x <= ceil($aantalProducten / $aantal); $x++): ?>
                <li class="page-item <?php echo ($_GET['paginanummer'] == $x) ? "active" : "" ?>"><a class="page-link" href="<?php echo SITELINK . "product/" . $_GET['cat'] . "/" . $_GET['id'] . "/pagina/" . $x . "/aantal:" . $aantal  ?>"><?php echo $x ?></a></li>
				<?php endfor; ?>
            </ul>
        </nav>
    </div><?php
    endif;

// Als de waarde van ID een nummer is haal het product op uit de database.

#TODO Filter de input waarde met de filter_var() functie.
elseif (is_numeric($_GET['id'])):
	$Product = ToonProduct($_GET['id']);

    // Als de request naar de database geen product weet te vinden, ga naar de productenpagina toe.
	if (empty($Product)):
	    GaNaarPagina("product");
	// Laat het product zien.
	else:
		if (!isset($_GET['product']) || $_GET['product'] !== strtolower(clean($Product['StockItemName']))):
			header("location: ". SITELINK ."product/". $Product['StockItemID']."/". strtolower(clean($Product['StockItemName'])) ."");
		endif;
		$andereFormaten = ToonFormatenbijProduct($Product['StockItemID']); ?>

        <div class="row align-items-center" style="margin-bottom: 50px">
            <div class="col-lg-4">
                <img src="<?php echo !empty($value['Photo']) ? $value['Photo'] : IMAGES . 'placeholder_150.png' ?>" alt="<?php echo !empty($value['Photo']) ? 'Afbeeldingen voor ' . $value['StockItemName'] : 'Placeholder afbeelding' ?>" title="<?php echo !empty($value['Photo']) ? 'Afbeeldingen voor ' . $value['StockItemName'] : 'Placeholder afbeelding' ?>" class="card-img-top" alt="...">
            </div>
            <div class="col-lg-8 product-overzicht">
                <h2><?php echo $Product['StockItemName']; ?></h2>
                <div class="product-desc"><?php echo $Product['MarketingComments']?></div>
                <div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> </div>
                <hr>
                <div class="product-prijs-voorraad d-flex">
                <div class="product-prijs">&euro;<?php echo DollarToEuro($Product['UnitPrice']) ?></div>
                <?php if($Product['QuantityOnHand'] >= MINIMUM_STOCK): ?>
                    <div class="product-voorraad" style="color: #007bff;">Op voorraad</div>
                <?php else: ?>
                    <div class="product-voorraad" style="color: #ff0003;">Niet op voorraad</div>
                <?php endif; ?>
                </div>
                <br>
		        <?php if($Product['QuantityOnHand'] > MINIMUM_STOCK): ?>
                <label for="aantal">Aantal: </label>
                <input data-input-aantal type="number" id="aantal" min="0" max="99" value="1" style="max-width: 70px;">
                <br>
				<?php endif; ?>
                <?php if(!empty($andereFormaten[0]->Size)): ?>
                <label for="">Formaat: </label>
                <select data-select-formaat id="formaat" name="formaat">
                    <?php foreach ($andereFormaten as $key => $value): ?>
                    <option value="<?php echo $value->StockItemID ?>" <?php echo $value->StockItemID == $_GET['id'] ? "selected" : "" ?>><?php echo $value->Size ?></option>
                    <?php endforeach; ?>
                </select>
                <?php endif; ?>
                <hr>
                <div class="btn-group cart d-flex">
		            <?php if($Product['QuantityOnHand'] > MINIMUM_STOCK): ?>
                    <a href="<?php echo SITELINK ."winkelwagen/". $Product['StockItemID']."/add/1" ?>" class="btn btn-success cta-knop-product-pagina product-knop">In mijn winkelmandje <i class="fa fa-shopping-basket"></i></a>
                    <?php endif; ?>
                    <?php if (isGebruikerIngelogd()): ?>
                    <a href="<?php echo SITELINK ."verlanglijst/". $Product['StockItemID']."/add/1" ?>" class="btn btn-link cta-knop-product-pagina verlanglijst-knop ">Op verlanglijstje <i class="fa fa-heart"></i></a>
					<?php endif; ?>
                </div>
            </div>
        </div>
        <?php
	endif;
endif;

?>
<script>
    // Aantal producten per pagina (productenoverzicht)
    document.addEventListener('DOMContentLoaded',function() {
        const selectorAantal = document.querySelector('select[data-select-aantal]');
        if (selectorAantal) {
            selectorAantal.onchange=AantalProductenPerPagina;
        }
    },false);

    function AantalProductenPerPagina(event) {
        window.location.href = '<?php echo SITELINK . "product/" . (isset($_GET['cat']) ? $_GET['cat'] : "") . "/" . $_GET['id'] . "/pagina/1/" ?>' + this.options[this.selectedIndex].value
    }

    // Wijzig het aantal items voor de knop "In mijn winkelmandje" (productdetail)
    document.addEventListener('DOMContentLoaded',function() {
        const selectorAantal = document.querySelector('input[data-input-aantal]');
        if (selectorAantal) {
            selectorAantal.onchange=WijzigWinkelWagenAantalHref;
        }
    },false);

    function WijzigWinkelWagenAantalHref(event) {
       const winkelmandjeKnop = document.querySelector('.product-knop');
        winkelmandjeKnop.href = '<?php echo SITELINK . "winkelwagen/" . $_GET['id'] . "/add/" ?>' + this.value
    }

    // Selecteer het juiste formaat en ga naar het product toe (productdetail > select)
    document.addEventListener('DOMContentLoaded',function() {
        const selectorAantal = document.querySelector('select[data-select-formaat]');
        if (selectorAantal) {
            selectorAantal.onchange=WijzigFormaatProductUitSelectie;
        }
    },false);

    function WijzigFormaatProductUitSelectie(event) {
        window.location.href = '<?php echo SITELINK . "product/" ?>' + this.options[this.selectedIndex].value
    }
</script>

