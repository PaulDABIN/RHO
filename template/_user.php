<div class="container-fluid">
	<div class="row">
		<section class="col-md-10 col-md-offset-1 col-xs-12" id="user-profile">
			<div class="col-md-4 col-xs-4">
				<?php if(!empty($user['picture'])): ?>
					<a href="profile.php"><img src="image/profile_pic/<?php echo $user['picture'] ?>" class="img-responsive" alt="user pic"></a>
				<?php else: ?>
					<a href="profile.php"><img src="image/profile_pic/no-pic-user.jpg" class="img-responsive" alt="no pic"></a>
				<?php endif; ?>
			</div>
			<div class="col-md-8 col-xs-8">
				<h3><?php echo $user['lname'] ?> <?php echo $user['fname'] ?></h3>
				<p>Département : <?php echo $user['code_postal'] ?></p>
			</div>
		</section>
		<section class="col-md-10 col-md-offset-1 col-xs-12">
			<h3 class="text-center"><?php echo $annonces[0]." : ".$annonces[1] ?></h3>
			<p class="text-center"><?php echo $annonces[2]; ?></p>
			<?php foreach($userAnnonces as $annonce): ?>
				<div class="row annonce">
					<div class="col-md-5 photo">
	                    <img src="image/assets/logo.png" class="img-annonce"/>
	                </div>
	                <div class="col-md-7">
	                    <div class="col-md-5">
	                        <h4><?php echo $annonce['titre'] ?></h4>
	                        <?php $name = selectUserAnnonces($db, $annonce['id_owner']); ?>
	                        <a class="nom_owner" href="user.php?status=<?php echo $annonce['id_owner'] ?>"><?php echo $name ?></a>
	                    </div>
	                    <div class="col-md-4 col-md-offset-3">
	                        <span class="date_annonce"><?php echo $annonce['dateevent']. ' - '.$annonce['codepostal'] ?>
	                        </span>
	                        <span class="date_publication"><?php echo "Postée le ".$annonce['datepubli'] ?></span>
	                    </div>
	                    <div class="col-md-12">
	                        <p><?php echo stripslashes($annonce['texte']) ?></p>
	                        <span class="recompense">Récompense : </span>
	                        <form method="POST" action="dash.php">
	                            <input type="hidden" value='<?php echo $annonce['id_annonce'] ?>' name="id_annonce"  >
	                            <input type="hidden" value='<?php echo $annonce['id_owner'] ?>' name="id_owner"  >
	                            <input type="submit"  class="interet" value="Postuler" name="intéressé" onclick="interet()">
	                        </form>
	                    </div>
	                </div>
				</div>
			<?php endforeach; ?>
		</section>
	</div>
</div>