<?php
	require 'vendor/autoload.php';
	require 'include/script_inc.php';
	//Initialisation de la request
	$request = new \App\Request($_SERVER['REQUEST_URI']);
	//On effectue les traitements et prepare une reponse
	$response = new \App\Response($request);
	$response->form = new \BootstrapForm($response);
	//Apres les verifications on envoie le message,et retourne les infos au visiteur
	$response->sendMail();
?>
