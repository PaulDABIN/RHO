<?php 
session_start();
//Main content and login
// _Finmagna-01
//Move to github
require 'config/config.php';
require 'model/functions.fn.php';
require 'model/flash.php';

if(!empty($_POST)){
	$mailValidator = '@';
	if (isset($_POST['edition'])){
		$fname = $_SESSION['fname'];
		$lname = $_SESSION['lname'];
		$email = $_SESSION['email'];
		$postal = $_SESSION['code_postal'];
		$image = $_SESSION['picture'];

		if(isset($_POST['fname']) && !empty($_POST['fname']))
			$fname = $_POST['fname'];
		if(isset($_POST['lname']) && !empty($_POST['lname']))
			$lname = $_POST['lname'];
		if (isset($_POST['email']) && !empty($_POST['email'])){
			$mailChecker = strpos($_POST['email'], $mailValidator);
			if($mailChecker === false)
				$flash = 'Entrer une adresse mail valide';
			else
				$email = $_POST['email'];
		}
		if(isset($_FILES['avatar']) && $_FILES['avatar']['error']==0){
			if($_FILES['avatar']['size']<=1000000){
				$ext = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'),1));
				if($ext=="jpg" || $ext=="png" || $ext=="gif"){
					$tailleimage = getimagesize($_FILES['avatar']['tmp_name']);
					if($tailleimage[0] <= 600 && $tailleimage[1] <= 600){
						$image = "";
						$path = 'image/profile_pic/'.uniqid(true).".".$ext;
						move_uploaded_file($_FILES['avatar']['tmp_name'],$path);
						$image = substr($path, 18);
					}
					else
						$flash = 'Votre avatar est trop grand (600x600 maximum)';
				}
				else
					$flash = 'Votre avatar n\'a pas le bon format(jpg, png, gif)';
			}
			else
				$flash = 'Votre avatar est trop lourde (1Mo maximum)';
		}
		if (isset($_POST['fname']) || isset($_POST['lname']) || isset($_POST['email']) || isset($_FILES['avatar']) || isset($_POST['postal_code'])){
			$updateUser = updateProfil($db, $fname, $lname, $email, $image, $postal, $_SESSION['id']);
			if($updateUser){
				$_SESSION['fname'] = $fname;
				$_SESSION['lname'] = $lname;
				$_SESSION['email'] = $email;
				$_SESSION['picture'] = $image;
				$_SESSION['code_postal'] = $postal;
				$_SESSION['flash'] = ["success", "Votre profil a été modifié avec succès."];
				header('Location: index.php');
			}
			else{
				$_SESSION['flash'] = ["danger", "Une erreur est survenu et votre profil n'a pas pu être modifié."];
				header('Location: index.php');
			}
		}
		/*if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['postal_code'])) {				
			$inscription = userRegistration($db, $_POST['fname'], $_POST['lname'], $_POST['email'], $password, $_POST['postal_code']);
			if ($inscription == true) {
				$content = '<h2>Bonjour '.$_POST['lname'].' '.$_POST['fname'].'</h2>
					<p>Vous venez de créer votre compte sur shareyourwork.com et nous vous remercions de votre confiance</p>
					<p>Vous pouvez dès à présent accéder à votre espace personnel</p>
					<p>Il vous permet de :</p>
					<ul>
						<li>Déposer une annonce, un événement</li>
						<li>Participer à une annonce, un événement</li>
					</ul>
					<br>
					<p>L\'équipe share your work</p>';

				$mail = sendMail($_POST['email'], 
					$_POST['fname'], 
					$_POST['lname'], 
					'Inscription Share your work', 
					$content, 
					'Votre compte est créer');
				if ($mail) {
					$_SESSION['flash'] = ["success", "Bienvenue ! L'équipe ShareYourWork vous a envoyé un mail."];
					header('Location: dash.php');
				}
				else{
					$_SESSION['flash'] = ["danger", "Une erreur s'est produite et nous n'avons pu vous envoyer de message."];
					header('Location: index.php');
				}
			}
			else{
				header('Location: index.php');
			}
		}*/
	}
	if (isset($_POST['edition-mdp'])){
		$pass;
		if(isset($_POST['password']) && isset($_POST['password2']) && !empty($_POST['password']) && !empty($_POST['password2'])){
			if($_POST['password'] !== $_POST['password2'])
				$flash = 'Les mots de passe ne coincide pas';
			elseif(!preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $_POST['password']))
				$flash = 'Le mot de passe n\'est pas assez sécurisé. il faut entre 8 et 30 caractères, incluant au moins une lettre majuscule, une minuscule, un chiffre et  un caractère spécial';
			else{
				$pass = password_hash($_POST['password'], PASSWORD_BCRYPT, 11);
				$passwordEdit = updateProfilPassword($db, $pass, $_SESSION['id']);
				if($passwordEdit){
					$_SESSION['flash'] = ["success", "Votre mot de passe a été modifié avec succès."];
					header('Location: index.php');
				}
				else{
					$_SESSION['flash'] = ["danger", "Une erreur est survenu et votre mot de passe n'a pas pu être modifié."];
					header('Location: index.php');
				}
			}
		}
	}
}
require 'template/_header.php';
require 'template/_profile_edit.php';
require 'template/_footer.php';	