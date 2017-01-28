<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<section class="connection-section">
				<div class="header row">
					<div class="col-md-1 col-xs-2">
						<img src="image/assets/logo.png" alt="logo RHO" class="img-responsive">
					</div>
					<div class="col-md-10 col-xs-8">
						<h3 class="text-center">Connexion</h3>
					</div>
					<div class="col-md-1 col-xs-2">
						
					</div>
				</div>
				<div class="content row">
					<form method="POST" action="#" id="connectMe" enctype="multipart/form-data" class="form-horizontal">
						<div class="form-group">
						    <div class="col-sm-10 col-sm-offset-1">
						      	<input type="email" class="form-control" name="email_connection" id="email-connection" placeholder="Adresse email">
						    </div>
						</div>
						<div class="form-group">
						    <div class="col-sm-10 col-sm-offset-1">
						      	<input type="password" class="form-control" name="password_connection" id="password-connection" placeholder="Mot de passe">
						    </div>
						</div>
						<div class="form-group">
						    <div class="col-sm-offset-1 col-sm-11">
						      	<div class="checkbox">
						        	<label>
						          		<input id="checkbox1" name="remenber" type="checkbox"> Rester connecté
						        	</label>
						      	</div>
						    </div>
						</div>
						<div class="form-group">
					  		<div class="col-sm-10 col-sm-offset-1">
								<button type="submit" name="connection" class="btn btn-block">Se connecter</button>
							</div>
					  	</div>
					</form>
				</div>
				<div class="footer row">
					<div class="text-center">
						<span>Vous n'avez pas de compte ?</span><a href="register.php">Inscrivez-vous</a>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>