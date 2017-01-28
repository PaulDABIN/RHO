<div id="register-form-insert"></div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<section class="inscription-section">
				<div class="header row">
					<div class="col-md-1 col-xs-2">
						<img src="image/assets/logo.png" alt="logo RHO" class="img-responsive">
					</div>
					<div class="col-md-10 col-xs-8">
						<h3 class="text-center">Inscription</h3>
					</div>
					<div class="col-md-1 col-xs-2">
						
					</div>
				</div>
				<div class="content row">
					<form method="POST" action="index.php" class="form-horizontal">
						<div class="form-group">
							<label for="fname" class="col-sm-2 control-label">Prénom</label>
						    <div class="col-sm-9">
						      	<input type="text" required class="form-control" name="fname" id="fname" placeholder="votre prénom">
						    </div>
						</div>
						<div class="form-group">
							<label for="lname" class="col-sm-2 control-label">Nom</label>
						    <div class="col-sm-9">
						      	<input type="text" required class="form-control" name="lname" id="lname" placeholder="votre nom">
						    </div>
						</div>
						<div class="form-group">
							<label for="email" class="col-sm-2 control-label">Email</label>
						    <div class="col-sm-9">
						      	<input type="email" required class="form-control" name="email" id="email" placeholder="votre email">
						    </div>
						</div>
						<div class="form-group">
							<label for="password" class="col-sm-2 control-label">Mot de passe</label>
						    <div class="col-sm-9">
						      	<input type="password" required class="form-control" name="password" id="password" placeholder="votre mot de passe"  pattern="(?=^.{8,30}$)(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&amp;*()_+}{&quot;:;'?/&gt;.&lt;,])(?!.*\s).*$" title="Entre 8 et 30 caractères, incluant au moins une lettre majuscule, une minuscule, un chiffre et  un caractère spécial">
						    </div>
						</div>
						<div class="form-group">
							<label for="password2" class="col-sm-2 control-label">Confirmation mot de passe</label>
						    <div class="col-sm-9">
						      	<input type="password" required class="form-control" name="password2" id="password2" placeholder="veuillez réecrire votre mot de passe">
						    </div>
						</div>
						<div class="form-group">
							<label for="postal_code" class="col-sm-2 control-label">Département</label>
						    <div class="col-sm-9">
						      	<input type="text" required class="form-control" name="postal_code" id="postal_code" placeholder="votre code postal">
						    </div>
						</div>
						<div class="col-sm-12">
							<p>En cliquant sur Inscription vous acceptez nos <a href="#">Conditions</a> et indiquer que vous avez lu <a href="#">notre Politique d'utilisation des données</a>, y compris notre utilisation des <a href="#">Cookies.</a></p>
						</div>
					  	<div class="form-group">
					  		<div class="col-sm-9 col-sm-offset-2">
								<button type="submit" name="inscription" class="btn btn-block">Inscription</button>
							</div>
					  	</div>
					</form>
					
				</div>
				<div class="footer row">
				</div>
			</section>
		</div>
	</div>
</div>