<?php

	require_once "lib/database_class.php";
	require_once "lib/manage_class.php";
	
	$system = NULL;
	$db = new DataBase();
	$manage = new Manage($db);
	if ($_POST["reg"]) {
		$r = $manage->regUser();
		$system .= "20";
	}
	elseif ($_POST["auth"]) {
		$r = $manage->login();
		$system .= "4f";
	}
	elseif ($_GET["logout"]) {
		$r = $manage->logout();
		$system .= "2e";
	}
	elseif ($_POST["poll"]) {
		$r = $manage->poll();
		$system .= "53";
	}
	else exit;
	$system .= "2e";
	$manage->redirect($r);

?>