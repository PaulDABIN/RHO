<?php
session_start();
require 'config/config.php';
require 'model/functions.fn.php';
require 'model/flash.php';

if(isset($_POST['connection'])) {
	if (isset($_POST['email_connection']) && isset($_POST['password_connection'])) {
		if (!empty($_POST['email_connection']) && !empty($_POST['password_connection'])) {
			$connect = userConnection($db, $_POST['email_connection'], $_POST['password_connection']);
			if($connect == true){
				if (isset($_POST['remenber'])) {
					$key = password_hash(uniqid(true), PASSWORD_BCRYPT, $options);
					$memory = memorize($db, $_POST['email_connection'], $_POST['password_connection'], $key);
					if ($memory == true) 
						setcookie("cuidProject",$key,time() + 2678400, null, null, false, true);
					else
						setcookie("cuidProject",$key,time() + 0, null, null, false, true);
				}
				$_SESSION['flash'] = ["success", "Vous êtes connecté"];
				header('Location: dash.php');
			}
			else{
				$_SESSION['flash'] = ["danger", 'Le couple email / mot de passe est incorrect'];
				header('Location: connection.php');
			}
		}
	}
}

if (!empty($_SESSION['id'])) {
	header('Location: dash.php');
}

require 'template/_header.php';
require 'template/_connection.php';
//require 'template/_footer.php';
?>