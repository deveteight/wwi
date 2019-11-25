<div class="row">
	<div class="col-lg-2">

	</div>
	<div class="col-lg-10">
		<div class="filter-tab">
			<div class="filteraantal">
				<h2><?php echo $Producten[0]['Stockgroupname'] ?></h2>
			</div>
			<div class="filteraantal">
				<span class="resultaten"><?php echo $aantalProducten; ?></span> resultaten |
				<label for="filteraantal">Aantal: </label>
				<select data-select-aantal id="filteraantal">
					<option value="aantal:5" <?php echo (isset($_GET['filter']) && $_GET['filter'] == "aantal:5") ? "selected" : "" ?>>5 producten</option>
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
							<p style="font-size: 0.9rem"><i class="fa fa-check-circle" style="color: rgb(158, 27, 40)"></i> Niet op voorraad</p>
						<?php endif; ?>
						<div class="sorteer">
							<p style="font-weight: bold; font-size: 1.15rem">&euro;<?php echo $value['UnitPrice']; ?></p>
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
</div>