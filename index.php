<?php 
session_start();
//Main content and login
// _Finmagna-01
require 'config/config.php';
require 'model/functions.fn.php';
//require 'model/flash.php';

$titleMeta = "SITE";

if (isset($_POST['deconnexion'])) {
	userDeconnection();
	//session_destroy();
}
if(!empty($_SESSION['id']))
	header('Location: dash.php');

else
	header('Location: connection.php');

/*require 'template/_header.php';
require 'template/main.php';
require 'template/_footer.php';*/