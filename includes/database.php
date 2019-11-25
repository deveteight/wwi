<?php

function connectionDB() {
	global $config;

	$dbConnection = $config['DBSERVER'];
	$dbPort = $config['DBPORT'];
	$dbName = $config['DBNAME'];
	$dbUser = $config['DBUSER'];
	$dbPassword = $config['DBPASSWORD'];
	$connection   =   'mysql:host='.$dbConnection.';port='.$dbPort.';';
	$databasename =   'dbname='.$dbName.';';
	$user         =   $dbUser;
	$password     =   $dbPassword;

	try {
		$db = new PDO($connection.$databasename,$user,$password);
		$db->exec('SET NAMES utf8');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
		die();
	}
	return $db;
}