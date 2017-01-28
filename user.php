<?php 
session_start();
require 'config/config.php';
require 'model/functions.fn.php';
require 'model/flash.php';

if(isset($_GET['status']) && !empty($_GET['status'])){
	$user = selectUser($db, $_GET['status']);
	if(!$user){
		$_SESSION['flash'] = ["danger", "l'utilisateur n'est pas valide"];
		header('Location: dash.php');
	}
	else
		$user = $user[0];

	$userAnnonces = selectAnnoncesOfUser($db, $_GET['status']);
	if($userAnnonces){
		$nbAnnonces = count($userAnnonces);
		$nbAnnonces > 1 ? $annonces = ["Annonces", $nbAnnonces, ""] : $annonces = ["Annonce", 1, ""];
	}
	else
		$annonces = ["Annonce", 0, "Cet utilisateur n'a pas posté d'annonces"];
}
else
	header('Location: dash.php');


require 'template/_header.php';
require 'template/_user.php';
require 'template/_footer.php';
?>