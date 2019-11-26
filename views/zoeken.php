<?php
	
	if (!isset($_GET['id'])):
	?>
		<h1>Hieronder zoeken a.u.b.</h1>
		<form action="<?php echo SITELINK . "zoeken/" ?>" method="get">
			<label for="id">Zoeken:</label>
			<input type="text" name="id"> <br>
			<input type="submit" value="Zoeken">
		</form>
	<?php
    // Je hebt gezocht naar $_GET['id], hieronder een overzicht...
    // Prijzen omzetten naar euro van dollar (USD)
	else:
		$Producten = ZoekDoorProducten($_GET['id']);
		?>
<h2 class="zoeken-tekst">Je zocht naar '<span><?php echo $_GET['id'] ?></span>' - <?php echo $Producten[0]['aantal'] . " producten gevonden"?></h2>
<div class="row">
    <div class="row d-flex justify-content-between" style="max-width: 1000px"><?php
    foreach ($Producten as $value):
        $tags = explode(",", $value['Tags']); ?>
        <div class="card col-lg-4" style="max-width: 300px; margin-bottom: 35px">
            <a href="<?php echo SITELINK ."product/". $value['StockItemID']."/". strtolower(clean($value['StockItemName'])) ?>"
               class="product-ahref"><img src="<?php echo !empty($value['Photo']) ? $value['Photo'] : IMAGES . 'placeholder_150.png' ?>"
                                          alt="<?php echo !empty($value['Photo']) ? 'Afbeeldingen voor ' . $value['StockItemName'] : 'Placeholder afbeelding' ?>"
                                          title="<?php echo !empty($value['Photo']) ? 'Afbeeldingen voor ' . $value['StockItemName'] : 'Placeholder afbeelding' ?>"
                                          class="card-img-top"
                                          alt="...">
            </a>
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


<!--		--><?php
//		if (!empty($x)):
//			?>
<!---->
<!--                <div class="col-lg-12">-->
<!--                    <div class="d-flex flex-wrap">-->
<!--						--><?php
//			foreach ($x as $item):
//                ?>
<!---->
<!--                    <div class="card col-lg-3 mt-4 text-center" style="width: 18rem;">-->
<!--                        <img src="--><?php //echo !empty($item->Photo) ? $item->Photo : IMAGES . 'placeholder_150.png' ?><!--" alt="--><?php //echo !empty($item->Photo) ? 'Afbeeldingen voor ' . $item->StockItemName : 'Placeholder afbeelding' ?><!--" title="--><?php //echo !empty($item->Photo) ? 'Afbeeldingen voor ' . $item->StockItemName : 'Placeholder afbeelding' ?><!--" class="card-img-top" alt="...">-->
<!--                        <div class="card-block">-->
<!--                            <h5 class="card-title">--><?php //echo $item->StockItemName; ?><!--</h5>-->
<!--                            <p class="card-text">--><?php //echo $item->MarketingComments; ?><!--</p>-->
<!--                            <p class="card-text">&euro;--><?php //echo DollarToEuro($item->UnitPrice); ?><!--</p>-->
<!--                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
<!--                            <a href="--><?php //echo SITELINK . "product/" . $item->StockItemID ?><!--" class="btn btn-primary">Bekijk product</a>-->
<!--                            <a href="--><?php //echo SITELINK ."winkelwagen/". $item->StockItemID ."/add/1" ?><!--" class="btn btn-success"><i class="fa fa-shopping-basket"></i></a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--            --><?php
//			    endforeach;
//			?>
<!--            </div>-->
<!--            </div>-->
<!--            --><?php
//		endif;


	endif;
?>

