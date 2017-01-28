<div id="resultat">
	<?php //_Finmagna-01 ?>
</div>
<div class="container-fluid">
	<div class="col-md-12">
		<section class="inscription-section panel">
			<h3 class="text-center">Modifier mon profil</h3>
			<form method="POST" action="profile_edit.php" enctype="multipart/form-data" class="form-horizontal">
				<div class="form-group">
					<label for="fname" class="col-sm-2 control-label">Prénom</label>
				    <div class="col-sm-9">
				      	<input type="text" class="form-control" name="fname" id="fname" placeholder="votre prénom">
				    </div>
				</div>
				<div class="form-group">
					<label for="lname" class="col-sm-2 control-label">Nom</label>
				    <div class="col-sm-9">
				      	<input type="text" class="form-control" name="lname" id="lname" placeholder="votre nom">
				    </div>
				</div>
				<div class="form-group">
					<label for="email" class="col-sm-2 control-label">Email</label>
				    <div class="col-sm-9">
				      	<input type="email" class="form-control" name="email" id="email" placeholder="votre email">
				    </div>
				</div>
				<div class="form-group">
					<label for="postal_code" class="col-sm-2 control-label">Code postal</label>
				    <div class="col-sm-9">
				      	<input type="text" class="form-control" name="postal_code" id="postal_code" placeholder="votre code postal">
				    </div>
				</div>
			  	<div class="form-group">
			  		<div class="col-md-12">
			  			<input class="center-block" type="file" name="avatar" id="avatars">
			  		</div>
			  	</div>
			  	<div class="form-group">
			  		<div class="col-sm-9 col-sm-offset-2">
						<button type="submit" name="edition" class="btn btn-primary">Envoyer</button>
					</div>
			  	</div>
			</form>
			<form method="POST" action="profile_edit.php" class="form-horizontal">
				<div class="form-group">
					<label for="password" class="col-sm-2 control-label">Mot de passe</label>
				    <div class="col-sm-9">
				      	<input type="password" class="form-control" name="password" id="password" placeholder="votre mot de passe" pattern="(?=^.{8,30}$)(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&amp;*()_+}{&quot;:;'?/&gt;.&lt;,])(?!.*\s).*$" title="Entre 8 et 30 caractères, incluant au moins une lettre majuscule, une minuscule, un chiffre et  un caractère spécial">
				    </div>
				</div>
				<div class="form-group">
					<label for="password2" class="col-sm-2 control-label">Confirmation mot de passe</label>
				    <div class="col-sm-9">
				      	<input type="password" class="form-control" name="password2" id="password2" placeholder="veuillez réecrire votre mot de passe">
				    </div>
				</div>
				<div class="form-group">
			  		<div class="col-sm-9 col-sm-offset-2">
						<button type="submit" name="edition-mdp" class="btn btn-primary">Envoyer</button>
					</div>
			  	</div>
			</form>
		</section>
	</div>
</div>