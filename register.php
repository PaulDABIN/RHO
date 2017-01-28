<?php
session_start();
require('config/config.php');
require('model/functions.fn.php');
require 'model/flash.php';

$mailValidator = '@';

$options = [
    'cost' => 11,
];

if (isset($_POST['inscription'])) {
	if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['postal_code'])) {
		if (!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['postal_code'])) {
			$mailChecker = strpos($_POST['email'], $mailValidator);
			if($mailChecker === false) {
				$flash = 'Entrer une adresse mail valide';
			}
			if($_POST['password'] !== $_POST['password2']){
				$flash = 'Les mots de passe ne coincide pas';
			}
			if (!preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $_POST['password'])) {
				$flash = 'Le mot de passe n\'est pas assez sécurisé. il faut entre 8 et 30 caractères, incluant au moins une lettre majuscule, une minuscule, un chiffre et  un caractère spécial';
			}
			else{
				$password = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);
				$inscription = userRegistration($db, $_POST['fname'], $_POST['lname'], $_POST['email'], $password, $_POST['postal_code']);
				if ($inscription == true){
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
			}
		}
	}
}

require 'template/_header.php';
require 'template/_register.php';
require 'template/_footer.php';