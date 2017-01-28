<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php if(isset($titleMeta)){echo $titleMeta;} ?> PBP</title>
    <link rel="stylesheet" href="lib/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="lib/css/style.css">
</head>
<body onresize="size()">
	<noscript>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="alert alert-info text-center" role="alert" id="javascript"><b>Your browser does not support JavaScript!</b><br>To have full fonctionnality on this page use a more recent <a href="https://www.google.fr/chrome/browser/desktop/" class="alert-link">browser</a></div>
				</div>
			</div>
		</div>
	</noscript>
	<div class="container-fluid">
		<div class="row">
			<header>

				<div class="row">
					<nav>
						<div class="col-md-offset-3 col-sm-offset-3">
							<ul class="nav nav-pills nav-justified">
								<li id="acceuil" role="presentation"><a href="dash.php">Accueil</a></li>
								<?php if(!empty($_SESSION['id'])): ?>
									<li id="profil" role="presentation"><a href="user.php?status=<?php echo $_SESSION['id'] ?>">Profil</a></li>
									<li id="deposit" role="presentation"><a href="ajout_annonce.php">Déposer</a></li>
									<li id="alert-notif" role="presentation"><a href="#">Alerte</a></li>
									<li id="settings" role="presentation"><a href="profile_edit.php">Paramètres</a></li>
									<!--<li id="deconnect" role="presentation"><a href="#">Déconnexion</a></li>-->
									<li id="deconnect" role="presentation">
									<form method="POST" action="index.php">
										<button type="submit" name="deconnexion" class="btn btn-block btn-default">Déconnexion</button>
									</form>
									</li>
								<?php else: ?>
									<li id="profil" role="presentation"><a href="connection.php">Profil</a></li>
									<li id="deposit" role="presentation"><a href="connection.php">Déposer</a></li>
									<li id="alert-notif" role="presentation"><a href="connection.php">Alerte</a></li>
									<li id="settings" role="presentation"><a href="connection.php">Paramètres</a></li>
									<li id="deconnect" role="presentation"><a href="connection.php">Connexion</a></li>
								<?php endif; ?>
							</ul>
						</div>
					</nav>
				</div>
			</header>
		</div>
		<div class="row" id="flash-message">
			<div class="col-md-8 col-xs-12 col-md-offset-2">
				<?php isset($flashType) ? $type = $flashType : $type = 'alert' ?>
				<?php if(isset($flash)): ?>
					<div class="alert alert-<?php echo $type ?> alert-dismissible fade in" role="alert">
						<button class="close" aria-label="Close" type="button" data-dismiss="alert">
					    	<span aria-hidden="true">&times;</span>
					  	</button>
					  	<p><?php echo $flash ?></p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	