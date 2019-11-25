<?php
	if (session_status() !== PHP_SESSION_ACTIVE):
		session_start();
	endif;
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="<?php echo CSS ?>bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo CSS ?>style.css">
	<title>Ingelogd....</title>
</head>
<body>
<nav class="navbar navbar-top header-top">
	<div class="container">
		<a class="navbar-brand" href="<?php LinkNaarPagina(); ?>">Ingelogd</a>
        <form class="form-inline" action="<?php LinkNaarPagina("zoeken/") ?>">
            <input class="form-control mr-sm-2" name="id" type="search" placeholder="Zoeken naar..." aria-label="Search">
        </form>
        <div class="knopjes">
		    <a class="btn btn-success" href="<?php LinkNaarPagina("winkelwagen")?>" title="Winkelmandje"><i class="fa fa-shopping-basket"></i></a>
		    <a class="btn verlanglijst-knop" style="color: white" href="<?php LinkNaarPagina("verlanglijst") ?>" title="Verlanglijstje"><i class="fa fa-heart"></i></a>
            <a class="btn btn-danger" href="<?php LinkNaarPagina("uitloggen") ?>" title="Uitloggen"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
        </div>
	</div>
</nav>
<nav class="navbar-down header-midden">
    <div class="container">
            <ul class="nav navbar-nav flex-item hidden-xs pull-right">
                <li><a href="#" class=""></a></li>
            </ul>
    </div>
</nav>
<div class="container">