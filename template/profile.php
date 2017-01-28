<div class="col-md-6 col-sm-8 col-xs-10 col-md-offset-3 col-sm-offset-2 col-xs-offset-1 top-pos-user profile-change">
	<div id="user-update-profile-pic"></div>
	<div class="col-md-3 col-sm-4 col-xs-12">
		<a class="btn btn-default btn-lg btn-block" href="dashboard.php" role="button" id="return-button">Retour</a>
	</div>
	<div class="col-md-5 col-sm-7 col-xs-12" id="return-title">
		<h1 class="text-center">Votre avatar</h1>
	</div>
	<br>
	<?php 
		if (isset($error)) {
			echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">';
			echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
				echo '<p class="text-center"><b>'.$error.'</b></p>';
			echo '</div>';
		}
	?>
	<br>
	<br>
	<h2 class="text-center"><?php echo $_SESSION['username'] ?></h2>
	<div class="col-xs-8 col-xs-offset-2">
		<?php
		if (!empty($_SESSION['picture']))
			echo '<img src="image/profile_pic/'.$_SESSION['picture'].'" id="user-info-img" class="img-responsive img-thumbnail center-block" alt="user pic">';
		else
			echo '<img src="image/profile_pic/no-pic-user.jpg" id="user-info-img" class="img-responsive img-thumbnail center-block" alt="no pic">';
		?>
	</div>
	<div class="col-xs-12">
		<form method="POST" action="profile.php" enctype="multipart/form-data">
			<div class="form-input">
				<p class="text-center" style="margin-top:15px; font-size:20px;">Sélectionner une image</p><input class="center-block" type="file" name="avatar" id="avatars">	
			</div>
			<input class="btn btn-default center-block" name="profile-update" type="submit" value="Envoyer mon image"style="margin-top:15px;">
		</form>
	</div>
</div>