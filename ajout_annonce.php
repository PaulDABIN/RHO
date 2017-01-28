<?php
session_start();
require ('config/config.php');
require 'model/functions.fn.php';
require 'model/flash.php';

if (isset($_POST['ajout'])){
	if(isset($_POST['codepostal']) && isset($_POST['dpt']) && isset($_POST['dateevent']) && isset($_POST['categorie']) && isset($_POST['titre']) && isset($_POST['texte'])){
		if(!empty($_POST['codepostal']) && !empty($_POST['dpt']) && !empty($_POST['dateevent']) && !empty($_POST['categorie']) && !empty($_POST['titre']) && !empty($_POST['texte'])){
			if(ctype_digit($_POST['codepostal']) && strlen($_POST['codepostal']) == 5){
				$codepostal = $_POST['codepostal'];
			    $categorie = $_POST['categorie'];
			    $titre = $_POST['titre'];
			    $texte = $_POST['texte'];
			    $dateevent = $_POST['dateevent'];
			    $id_owner = $_SESSION['id'];
			    $image = "";
			    if(isset($_FILES['avatar']) && $_FILES['avatar']['error']==0){
			    	$flashType = "danger";
					if($_FILES['avatar']['size']<=1000000){
						$ext = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'),1));
						if($ext=="jpg" || $ext=="png"){
							$tailleimage = getimagesize($_FILES['avatar']['tmp_name']);
							if($tailleimage[0] <= 600 && $tailleimage[1] <= 600){
								$image = "";
								$path = 'image/annonce_pic/'.uniqid(true).".".$ext;
								move_uploaded_file($_FILES['avatar']['tmp_name'],$path);
								$image = substr($path, 18);
								$newAnnonce = ajoutAnnonce($db,$dateevent, $codepostal, $titre, $texte, $categorie, $id_owner, $image);
								if($newAnnonce){
									$_SESSION['flash'] = ["success", 'Votre annonce a été ajouté avec succès'];
									header('Location: dash.php');
								}
								else{
									$_SESSION['flash'] = ["danger", 'Votre annonce n\'a pas pu être posté'];
									header('Location: ajout_annonce.php');
								}	
							}
							else
								$flash = 'Votre image est trop grande (600x600 maximum)';
						}
						else
							$flash = 'Votre image n\'a pas le bon format(jpg, png)';
					}
					else
						$flash = 'Votre image est trop lourde (1Mo maximum)';
				}
				if($_FILES['avatar']['size'] === 0){
					$newAnnonce = ajoutAnnonce($db,$dateevent, $codepostal, $titre, $texte, $categorie, $id_owner, $image);
					if($newAnnonce){
						$_SESSION['flash'] = ["success", 'Votre annonce a été ajouté avec succès'];
						header('Location: dash.php');
					}
					else{
						$_SESSION['flash'] = ["danger", 'Votre annonce n\'a pas pu être posté'];
						header('Location: ajout_annonce.php');
					}
				}
			}
			else{
				$_SESSION['flash'] = ["danger", 'Veuillez rentrer un code postal valable <strong>(ex: 47200)</strong>'];
				header('Location: ajout_annonce.php');
			}
		}
		else{
			$_SESSION['flash'] = ["danger", 'Certains des champs sont vide'];
			header('Location: ajout_annonce.php');
		}
	}
	else{
		$_SESSION['flash'] = ["danger", 'Tous les champs n\'ont pas été renseignés'];
		header('Location: ajout_annonce.php');
	}    
};

require 'template/_header.php';
require 'template/ajout_annonce.php';
require 'template/_footer.php';
?>