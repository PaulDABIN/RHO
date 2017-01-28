<?php
require 'PHPMailerAutoload.php';
/*******************************************************************
SUMMARY
	1!FUNCTIONS
		1.1!userRegistration
		1.2!userConnection
		1.3!selectTweets
		1.4!selectTweet
		1.5!insertTweet
		1.6!updateTweet
		1.7!deleteTweet
		1.8!isEmailAvailable
		1.9!isUsernameAvailable
		2.0!isTweetOwner
		2.1!updateProfilPicture	

********************************************************************/

/**************************************************
					1!FUNCTIONS
**************************************************/
		/*1.1!userRegistration
			return :
				true for registration OK
				false for fail
			$db -> 				database object
			$username -> 		field value : username
			$email -> 			field value : email
			$password -> 		field value : password
		*/
	function userRegistration($db, $fname, $lname, $email, $password, $postalCode){
		//$availableUser = isUsernameAvailable($db, $username);
		$availableEmail = isEmailAvailable($db, $email);
		//$availablePassword = isPasswordAvailable($db, $passwordReadable);
		if (empty($availableEmail)) {
			try{
				$sql = "INSERT INTO users SET fname = :fname, lname = :lname, email = :email, password = :password, code_postal = :code_postal";
				$req = $db->prepare($sql);
				$req->execute(array(':fname' => $fname, ':lname' => $lname, ':email' => $email, ':password' => $password, ':code_postal' => $postalCode));
				$result = $req->fetchAll(PDO::FETCH_ASSOC);
				//var_dump($result);
				return true;
			}
			catch (PDOException $e){
				print 'Erreur PDO : '.$e->getMessage().'<br/>';
				die();
			}
		}
		else{
			$_SESSION['flash'] = ["alert", "Cette adresse mail n'est pas disponible."];
		}
	}

	function memorize($db, $email, $password, $key){
		try{
			$sql = "UPDATE `users` SET `key_connection` = '$key' WHERE `email` = '$email' LIMIT 1";
			$req = $db->prepare($sql);
			$req->execute();
			$result = $req->fetchAll(PDO::FETCH_ASSOC);
			return true;
		}
		catch (PDOException $e){
			print 'Erreur PDO : '.$e->getMessage().'<br/>';
			die();
		}
	}


		/*1.2!userConnection
			return :
				true for connection OK
				false for fail
			$db -> 				database object
			$email -> 			field value : email
			$password -> 		field value : password
		*/
	function userConnection($db, $email, $password){
		$sql = "SELECT * FROM users WHERE `email` = '$email' LIMIT 1";
		$req = $db->prepare($sql);
		$req->execute();
		$result = $req->fetch(PDO::FETCH_ASSOC);
		//Si le fetch réussi, alors un résultat a été retourné donc le couple email / password est correct
		if($result == true){
			//on définit la SESSION
			if (password_verify($password, $result['password'])) {
				$_SESSION['id'] = $result['id'];
				$_SESSION['fname'] = $result['fname'];
				$_SESSION['lname'] = $result['lname'];
				$_SESSION['email'] = $result['email'];
				$_SESSION['created_at'] = $result['created_at'];
				$_SESSION['picture'] = $result['picture'];
				$_SESSION['code_postal'] = $result['code_postal'];
				return true;
			}
			else
				return false;
		}
		else{
			return false;
		}
	}

	function userDeconnection(){
		//delete cookie
		//setcookie("cuidProject",0,time() + 0, null, null, false, true);
		$_SESSION = array();
		$_SESSION['flash'] = ["success", "Vous avez été déconnecté"];
		header('Location: connection.php');
	}

	function remenberConnection($db, $key){
		//Requête SQL
		$sql = "SELECT * FROM users WHERE `key_connection` = '$key'";
		$req = $db->prepare($sql);
		$req->execute();
		$result = $req->fetch(PDO::FETCH_ASSOC);
		//var_dump($req);
		//Si le fetch réussi, alors un résultat a été retourné donc le couple email / password est correct
		if($result == true){
			//on définit la SESSION
			$_SESSION['id'] = $result['id'];
			$_SESSION['fname'] = $result['fname'];
			$_SESSION['lname'] = $result['lname'];
			$_SESSION['email'] = $result['email'];
			$_SESSION['created_at'] = $result['created_at'];
			$_SESSION['picture'] = $result['picture'];
			$_SESSION['code_postal'] = $result['code_postal'];
			setcookie("cuidProject",$key,time() + 2678400, null, null, false, true);
			return true;
		}else{
			return false;
		}
	}

	/*2.1!updateProfilPicture
		return : 
			'ok' if image is changed
			'{error}' if there is an error
		$db -> 				database object
		$imgInfos ->		must be $_FILES['image'] => $imgInfos = $FILES['image']
		$user_id -> 		user's id (picture's owner) | must use $_SESSION['id']
	*/
	function updateProfil($db, $fname, $lname, $email, $imgInfos, $postal, $user_id){
		try{
			$sql = "UPDATE users SET fname = :fname, lname = :lname, email = :email, picture = :picture, code_postal = :code_postal WHERE id = :id";
			$req = $db->prepare($sql);
		  	$req->execute(array('fname' => $fname, 'lname' => $lname, 'email' => $email, 'picture' => $imgInfos, 'code_postal' => $postal, 'id' => $user_id));
		  	$result = $req->fetchAll(PDO::FETCH_ASSOC);
			return true;
		}
		catch (PDOException $e){
			print 'Erreur PDO : '.$e->getMessage().'<br/>';
			die();
		}
	}
	function updateProfilPassword($db, $pass, $user_id){
		try{
			$sql = "UPDATE users SET password = :password WHERE id = :id";
			$req = $db->prepare($sql);
		  	$req->execute(array('password' => $pass, 'id' => $user_id));
		  	$result = $req->fetchAll(PDO::FETCH_ASSOC);
			return true;
		}
		catch (PDOException $e){
			print 'Erreur PDO : '.$e->getMessage().'<br/>';
			die();
		}
	}

	function selectArticles($db){
		try{
			$sql = "SELECT * FROM articles ORDER BY created_at DESC";
			$req = $db->prepare($sql);
			$req->execute(); 
			$result = $req->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		catch (PDOException $e){
			print 'Erreur PDO : '.$e->getMessage().'<br/>';
			die();
		}
	}

	function selectUserArticles($db, $id){
		try{
			$sql = "SELECT * FROM articles WHERE user_id = $id ORDER BY created_at DESC";
			$req = $db->prepare($sql);
			$req->execute(); 
			$result = $req->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		catch (PDOException $e){
			print 'Erreur PDO : '.$e->getMessage().'<br/>';
			die();
		}
	}




	function selectArticleComments($db, $id){
		try{
			$sql = "SELECT * FROM comments WHERE article_id = $id ORDER BY created_at DESC";
			$req = $db->prepare($sql);
			$req->execute();
			$result = $req->fetchAll(PDO::FETCH_ASSOC);
			//comments array and foreach addition
			$comments = array();
			foreach ($result as $comment) {
				$id = $comment['id'];
				$comment['childs'] = array();
				$comments[$id] = $comment;
			}
			foreach ($comments as $k => &$v) {
			  	if ($v['parent'] != 0) {
			    	$comments[$v['parent']]['childs'][] =& $v;
			  	}
			}
			unset($v);
			// delete the childs comments from the top level
			foreach ($comments as $k => $v) {
			  	if ($v['parent'] != 0) {
			    	unset($comments[$k]);
			  	}
			}
			return $comments;
		}
		catch (PDOException $e){
			print 'Erreur PDO : '.$e->getMessage().'<br/>';
			die();
		}
	}

	// now we display the comments list, this is a basic recursive function
	function display_comments(array $comments, $level = 0) {
		//var_dump($comments);
	  	foreach ($comments as $comment) {
	    	//echo str_repeat('-', $level + 1).' comment '.$comment['id']."<br>";
	    	$width = 12 - $level;
	    	$reg = substr($comment['created_at'],0,10);
	    	$year = substr($reg,0,4);
			$month = substr($reg,5,2);
			$day = substr($reg,-2,2);
	    	echo '
	    		<div class="col-xs-'.$width.' col-xs-offset-'.$level.'  comment-info bg-info">
					<div class="col-xs-11">
						<p>Le '.$day.'/'.$month.'/'.$year.'</p>
						<p>'.$comment['content'].'</p>
					</div>
					<div class="col-xs-1">
						<a href="article.php?id='.$_GET['id'].'&delete=true" role="button" class="close">
							<span aria-hidden="true">&times;</span>
						</a>
						<a href="article.php?id='.$_GET['id'].'&parent='.$comment['id'].'" role="button" class="close rep">
							Répondre
						</a>
					</div>
				</div>
	    	';
	    	if (!empty($comment['childs'])) {
	      		display_comments($comment['childs'], $level + 1);
	    	}
	  	}
	}


		/*1.4!selectTweet
			return : 
				selected tweet in array
			$db -> 				database object
			$tweet_id ->				tweet's id
		*/
	function selectArticle($db, $article_id){
		try{
			$sql = "SELECT * FROM articles WHERE id = '".$article_id."'";
			$req = $db->prepare($sql);
			$req->execute(); 
			$result = $req->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		catch (PDOException $e){
			print 'Erreur PDO : '.$e->getMessage().'<br/>';
			die();
		}
	}


		/*1.5!insertTweet
			return : 
				true
			$db -> 				database object
			$user_id ->			user's id (must be current $_SESSION['id'])
			$message ->			field value : message
		*/
	function insertArticles($db, $user_id, $title, $image, $content){
		try{
			$sql = "INSERT INTO articles SET user_id = :user_id, title = :title, image = :image, content = :content";
			$req = $db->prepare($sql);
			$req->execute(array(':user_id' => $user_id, ':title' => $title, ':image' => $image , ':content' => $content));
			$result = $req->fetchAll(PDO::FETCH_ASSOC);
			return true;
		}
		catch (PDOException $e){
			print 'Erreur PDO : '.$e->getMessage().'<br/>';
			die();
		}
	}

	function insertComment($db, $user_id, $article_id, $content, $parent = null){
		try{
			$sql = "INSERT INTO comments SET user_id = :user_id, article_id = :article_id, content = :content, parent = :parent";
			$req = $db->prepare($sql);
			$req->execute(array(':user_id' => $user_id, ':article_id' => $article_id, ':content' => $content, ':parent' => $parent));
			$result = $req->fetchAll(PDO::FETCH_ASSOC);
			return true;
		}
		catch (PDOException $e){
			print 'Erreur PDO : '.$e->getMessage().'<br/>';
			die();
		}
	}


		/*1.6!updateTweet
			return : 
				true if updated
				false for bad ownership or empty message
			$db -> 				database object
			$tweet_id ->				tweet's id
			$message ->			field value : message
			$user_id -> 		user's id (tweet's owner) | must use $_SESSION['id']
		*/
	function updateArticle($db, $article_id, $user_id, $content, $title, $image){
		try{
			$sql = "UPDATE articles SET content = :content, title = :title, image = :image WHERE id = :id AND user_id = :user_id";
			$req = $db->prepare($sql);
		  	$req->execute(array('content' => $content, 'title' => $title, 'image' => $image, 'id' => $article_id, 'user_id' => $user_id));
		  	$result = $req->fetchAll(PDO::FETCH_ASSOC);
			return true;
		}
		catch (PDOException $e){
			print 'Erreur PDO : '.$e->getMessage().'<br/>';
			die();
		}
	}


		/*1.7!deleteTweet
			return : 
				true if deleted
				false for fail
			$db -> 				database object
			$tweet_id ->				tweet's id
			$user_id -> 		user's id (tweet's owner) | must use $_SESSION['id']
		*/
	function deleteElement($db, $table, $element_id, $user_id){
		try{
			$sql = "DELETE FROM $table WHERE id = :id AND user_id = :user_id";
			$req = $db->prepare($sql);
			$req->execute(array(':id' => $element_id, ':user_id' => $user_id));
			$result = $req->fetchAll(PDO::FETCH_ASSOC);
			return true;
		}
		catch (PDOException $e){
			print 'Erreur PDO : '.$e->getMessage().'<br/>';
			die();
		}
	}


		/*1.8!isEmailAvailable
			return : 
				true if email is available
				false if email is not available
			$db -> 				database object
			$email ->			email's value to verify
		*/
	function isEmailAvailable($db, $email){
		try{
			$sql = "SELECT email FROM users WHERE email = '".$email."'";
			$req = $db->prepare($sql);
			$req->execute(); 
			$result = $req->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		catch (PDOException $e){
			print 'Erreur PDO : '.$e->getMessage().'<br/>';
			die();
		}
	}

	function isPasswordAvailable($db, $password){
		try{
			$sql = "SELECT password FROM users";
			$req = $db->prepare($sql);
			$req->execute(); 
			$result = $req->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $user) {
				if(password_verify($password, $user['password'])) {
					return $result;
				}
			}
			return;
		}
		catch (PDOException $e){
			print 'Erreur PDO : '.$e->getMessage().'<br/>';
			die();
		}
	}		


		/*1.9!isUsernameAvailable
			return : 
				true if username is available
				false if username is not available
			$db -> 				database object
			$username ->		username's value to verify
		*/
	function isUsernameAvailable($db, $username){
		try{
			$sql = "SELECT username FROM users WHERE username = '".$username."'";
			$req = $db->prepare($sql);
			$req->execute(); 
			$result = $req->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		catch (PDOException $e){
			print 'Erreur PDO : '.$e->getMessage().'<br/>';
			die();
		}
	}		


		/*2.0!isTweetOwner
			return : 
				true if it's the good owner
				false if someone try to edit another user's tweet
			$db -> 				database object
			$tweet_id ->		tweet's id
			$user_id -> 		user's id
		*/
	function isOwner($db, $table, $article_id, $user_id){
		try{
			$sql = "SELECT * FROM $table WHERE user_id = $user_id AND id = $article_id";
			$req = $db->prepare($sql);
			$req->execute(); 
			$result = $req->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		catch (PDOException $e){
			print 'Erreur PDO : '.$e->getMessage().'<br/>';
			die();
		}
	}

	function isCommentOwner($db, $comment_id, $user_id){
		try{
			$sql = "SELECT * FROM comments WHERE user_id = $user_id AND id = $comment_id";
			$req = $db->prepare($sql);
			$req->execute(); 
			$result = $req->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		catch (PDOException $e){
			print 'Erreur PDO : '.$e->getMessage().'<br/>';
			die();
		}
	}

	function getArticleAutor($db, $user_id){
		try{
			$sql = "SELECT * FROM users WHERE id = $user_id LIMIT 1";
			$req = $db->prepare($sql);
			$req->execute(); 
			$result = $req->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		catch (PDOException $e){
			print 'Erreur PDO : '.$e->getMessage().'<br/>';
			die();
		}
	}


function ajoutAnnonce($db, $dateevent, $codepostal, $titre, $texte, $categorie, $id_owner, $image){

	try{
		$date = date("Y-m-d H:i:s");    // $date est la date du jour de la création de l'annonce
		$sql = "INSERT INTO
  			    annonces
      		SET
      		  dateevent = :dateevent,
      		  codepostal = :codepostal,
      		  titre = :titre,
      		  texte = :texte,
      		  categorie = :categorie,
      		  id_owner = :id_owner,
      		  image = :image,
      		  datepubli = :date
      		";
		$req = $db->prepare($sql);
		$req->execute(array(
			':dateevent' => $dateevent, ':date'	=>	$date, ':codepostal' => $codepostal, ':titre' => $titre, ':texte' => $texte , ':categorie' => $categorie, ':id_owner' => $id_owner, ':image' => $image));
		$result = $req->fetchAll(PDO::FETCH_ASSOC);
		return true;
	}
	catch (PDOException $e){
		print 'Erreur PDO : '.$e->getMessage().'<br/>';
		die();
	}
}



function recursive_array_search($needle,$haystack) {
	foreach($haystack as $key=>$value) {
		$current_key=$key;
		if($needle===$value OR (is_array($value) && recursive_array_search($needle,$value) !== false)) {
			return $current_key;
			var_dump($current_key);
		}
	}
	return false;
}

/* fonction qui va checker si des paramètres de filtres sont rentrés.
Si oui, effectue le filtre.
Si non, appelle la fonction d'affichage clasique (affichageAnnone()) */

function filtrageAnnonce($db)
{
	try {
        $req = $db->prepare("SELECT * FROM annonces ORDER BY dateevent DESC");
        $req->execute();
        $datelocale = date("Y-m-d");
        $row = $req->fetchAll(); //2 valeurs select
        $verif = 0;
        //var_dump($row);
        foreach ($row as $key => $value) {
            $row[$key][0] = $value['id_annonce'];
            $row[$key][1] = $value['titre'];
            $row[$key][2] = $value['texte'];
            $row[$key][3] = $value['categorie'];
            $row[$key][4] = $value['codepostal'];
            $row[$key][5] = $value['datepubli'];
            $row[$key][6] = $value['dateevent'];
            $row[$key][7] = $value['id_owner'];
            $row[$key][8] = $value['departement'];

            if(isset($_POST['Aujourdhui'])){
                $verif = 1;
                if ( $value['dateevent'] !== $datelocale){

                    unset($row[$key]);
                }
            }
            else{
                if (!empty($_POST['postal_code'])) {
                $departement = $_POST['postal_code'];
                $verif = 1;

                if (strcasecmp($departement, $value['departement']) !== 0) { //permet de comparer 2 strings sans considérer la casse
                    unset($row[$key]);
                }
            }

            if (!empty($_POST['codepostal'])) {
                $ville = $_POST['codepostal'];
                $verif = 1;

                if ($ville !== $value['codepostal']) { //permet de comparer 2 strings sans considérer la casse

                    unset($row[$key]);
                }
            }

            if (!empty($_POST['dateevent'])) {
                $dateform = $_POST['dateevent'];
                $verif = 1;
                if (($value['dateevent'] < $datelocale) || ($value['dateevent'] > $dateform)) {

                    unset($row[$key]);
                }
            }
            if (!empty($_POST['datepubli'])) {
                $date = $_POST['datepubli'];
                $verif = 1;
                if ($date !== $value['datepubli']) {
                    unset($row[$key]);
                }
            }

            if (!empty($_POST['titre'])) {
                $titre = $_POST['titre'];
                $verif = 1;
                if (!strstr($value['titre'], $titre)) {
                    unset($row[$key]);
                }
            }

            if (!empty($_POST['categorie'])) {
                $categorie = $_POST['categorie'];
                $verif = 1;
                if (strcasecmp($categorie, $value['categorie']) == 0) { //permet de comparer 2 strings sans considérer la casse
                    unset($row[$key]);
                }
            }
        }
    }
        if($verif == 0){
            if(!empty($row)){
                affichageAnnonce($db);
            }
            else{
                echo 'Il n y a pas d annonces correspondants à ces critères de recherche' ;
            }
        }

        else{
            $result = count($row);
            $row = array_values($row);
            for($i=0;$i<$result;$i++){
                       $name = selectUserAnnonces($db, $row[$i][7]);
    	   echo '
    	    <div class="col-md-10 col-md-offset-1 annonce">
                <div class="col-md-5 photo">';
                if(!empty($value['image']))
                    echo '<img src="image/annonce_pic/'.$value['image'].'" alt="image annonce" class="img-annonce"/>';
                else
                	echo '<img src="image/assets/logo.png" class="img-annonce"/>';
                echo '</div>
                <div class="col-md-7">
                    <div class="col-md-5">
                        <h4>' . $row[$i][1] . '</h4>
                        <a class="nom_owner" href="user.php?status='.$value['id_owner'].'">'.$name.'</a>
                    </div>
                    <div class="col-md-4 col-md-offset-3">
                        <span class="date_annonce">'.$row[$i][6]. ' - ' .$row[$i][4].'</span>
                        <span class="date_publication">'. ' Postée le '. $row[$i][5] . '</span>
                    </div>
                    <div class="col-md-12">
                        <p>' . stripslashes($row[$i][2]). '</p>
                        <span class="recompense">Récompense : </span>
                        <form method="POST" action="dash.php">
                            <input type="hidden" value=' . $row[$i][0]. ' name="id_annonce"  >
                            <input type="hidden" value=' . $row[$i][7] . ' name="id_owner"  >
                            <input type="submit"  class="interet" value="Postuler" name="intéressé" onclick="interet()">
                        </form>
                    </div>
                </div>
   	        </div><br/>
			 ';
            }
        }
	}
	catch (PDOException $e){
		print 'Erreur PDO : '.$e->getMessage().'<br/>';
		die();
	}

}

function selectUser($db, $id_user){
	try{
        $sql = "SELECT * FROM users WHERE id = $id_user LIMIT 1";
        $req = $db->prepare($sql);
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }
    catch (PDOException $e){
        print 'Erreur PDO : '.$e->getMessage().'<br/>';
        die();
    }
}

function selectAnnoncesOfUser($db, $id_user){
	try{
        $sql = "SELECT * FROM annonces WHERE id_owner = $id_user";
        $req = $db->prepare($sql);
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }
    catch (PDOException $e){
        print 'Erreur PDO : '.$e->getMessage().'<br/>';
        die();
    }
}

function selectUserAnnonces($db, $id_user){
    try{
        $sql = "SELECT * FROM users WHERE id = $id_user ORDER BY created_at DESC";
        $req = $db->prepare($sql);
        $req->execute();
        $row = $req->fetchAll(PDO::FETCH_ASSOC);

        foreach ($row as $key => $value) {

            $lname = $value['lname'].' '.$value['fname'];

            return $lname;
        }
    }
    catch (PDOException $e){
        print 'Erreur PDO : '.$e->getMessage().'<br/>';
        die();
    }
}

function affichageAnnonce($db){
	try {
        $req = $db->prepare("SELECT * FROM annonces ORDER BY dateevent DESC");
        $req->execute();
        $row = $req->fetchAll();

        $datelocale = date("Y-m-d");
        $etat = "demande";

        foreach ($row as $key => $value) {

            $name = selectUserAnnonces($db, $value['id_owner']);

            if ($value['dateevent'] >= $datelocale) {

                echo '
    	    <div class="col-md-10 col-md-offset-1 annonce">   
                <div class="col-md-5 photo">';
                if(!empty($value['image']))
                    echo '<img src="image/annonce_pic/'.$value['image'].'" alt="image annonce" class="img-annonce"/>';
                else
                	echo '<img src="image/assets/logo.png" class="img-annonce"/>';
                echo '</div>   
                <div class="col-md-7">
                    <div class="col-md-5">
                        <h4>' . $value['titre'] . '</h4>
                        <a class="nom_owner" href="user.php?status='.$value['id_owner'].'">'.$name.'</a>
                    </div>
                    <div class="col-md-4 col-md-offset-3">
                        <span class="date_annonce">' . $value['dateevent'] . ' - ' . $value['codepostal'] . '</span>
                        <span class="date_publication">' . ' Postée le ' . $value['datepubli'] . '</span>
                    </div>
                    <div class="col-md-12">
                        <p>' . stripslashes($value['texte']) . '</p>
                        <span class="recompense">Récompense : </span>
                        <form method="POST" action="dash.php">
                            <input type="hidden" value=' . $value['id_annonce'] . ' name="id_annonce"  >
                            <input type="hidden" value=' . $value['id_owner'] . ' name="id_owner"  >
                            <input type="submit"  class="interet" value="Postuler" name="intéressé" onclick="interet()">
                        </form>
                    </div>
                </div>
   	        </div><br/>
		';
            }

        }
    }
    catch (PDOException $e){
		print 'Erreur PDO : '.$e->getMessage().'<br/>';
		die();
	}
}




function suppressionAnnonce($db,$id_annonce, $id_user){
	header('Location: dash.php');
	try{
		$sql = "DELETE FROM annonces WHERE id_annonce = :id_annonce  AND id_owner = :id_user";
		$req = $db->prepare($sql);
		$req->execute(array(':id_annonce' => $id_annonce, ':id_user' => $id_user));
		$result = $req->fetchAll(PDO::FETCH_ASSOC);
		return true;
	}
	catch (PDOException $e){
		print 'Erreur PDO : '.$e->getMessage().'<br/>';
		die();
	}
}

function interet($db,$id_annonce, $id_user, $id_owner, $etat){
    try{
        $sql = "SELECT * FROM interet ";
        $req = $db->prepare($sql);
        $req->execute();
        $row = $req->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($row)){

            foreach ($row as $key => $value){

                if(($value['id_user'] == $id_user) && ($value['id_annonce'] == $id_annonce)){
                    echo 'vous avez déjà postulé';
                }
                elseif($id_owner == $id_user){
                    echo 'vous ne pouvez pas postuler à votre annonce';
                }
                else{
                    echo 'on va ajouter';
                    try {
                        $sql = "INSERT INTO interet(id_annonce, id_owner, id_user, etat) VALUES (:id_annonce, :id_owner, :id_user, :etat)";
                        $req = $db->prepare($sql);
                        $req->execute(array(':id_annonce' => $id_annonce, ':id_owner' => $id_owner, ':id_user' => $id_user, ':etat' => $etat));
                        $result = $req->fetchAll(PDO::FETCH_ASSOC);

                        try{
                            $sql = "SELECT * FROM users WHERE id = $id_owner";
                            $req = $db->prepare($sql);
                            $req->execute();
                            $row = $req->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($row as $key => $value) {
                                //var_dump($value['email']);
                                $subject = "Un utilisateur a postulé à une de vos annonces!";
                                $content = "Félicitations";
                                $returnText = "test";
                                //sendMail($value['email'], $value['fname'], $value['lname'], $subject, $content, $returnText);
                                //echo 'Votre demande d intérêt à bien été envoyée';
                            }
                        }
                        catch (PDOException $e){
                            print 'Erreur PDO : '.$e->getMessage().'<br/>';
                            die();
                        }
                    }
                    catch (PDOException $e){
                        print 'Erreur PDO : '.$e->getMessage().'<br/>';
                        die();
                    }
                }
            }
        }
        else{
           if($id_owner == $id_user){
               echo 'vous ne pouvez pas postuler à votre annonce';
           }

           else{
               echo 'on va ajouter';
               try {
                   $sql = "INSERT INTO interet(id_annonce, id_owner, id_user, etat) VALUES (:id_annonce, :id_owner, :id_user, :etat)";
                   $req = $db->prepare($sql);
                   $req->execute(array(':id_annonce' => $id_annonce, ':id_owner' => $id_owner, ':id_user' => $id_user, ':etat' => $etat));
                   $result = $req->fetchAll(PDO::FETCH_ASSOC);
                   //interetbis($db, $id_owner);

                   try{
                       $sql = "SELECT * FROM users WHERE id = $id_owner";
                       $req = $db->prepare($sql);
                       $req->execute();
                       $row = $req->fetchAll(PDO::FETCH_ASSOC);
                       foreach ($row as $key => $value) {
                           //var_dump($value['email']);
                           $subject = "Un utilisateur a postulé à une de vos annonces!";
                           $content = "Félicitations";
                           $returnText = "test";
                           //sendMail($value['email'], $value['fname'], $value['lname'], $subject, $content, $returnText);
                           //echo 'Votre demande d intérêt à bien été envoyée';
                       }
                   }
                   catch (PDOException $e){
                       print 'Erreur PDO : '.$e->getMessage().'<br/>';
                       die();
                   }
               }
               catch (PDOException $e){
                   print 'Erreur PDO : '.$e->getMessage().'<br/>';
                   die();
               }
           }
       }
    }
    catch (PDOException $e){
        print 'Erreur PDO : '.$e->getMessage().'<br/>';
        die();
    }


}



function interetbis($db, $id_owner)
{
    try {


    }

    catch (PDOException $e){
        print 'Erreur PDO : '.$e->getMessage().'<br/>';
        die();
    }
}
/*function modifAnnonce($db,$id_annonce, $id_user, $id_owner, $etat){
	//header('Location: dash.php');
	try{
		$sql = "INSERT INTO interet(id_annonce, id_owner, id_user, etat) VALUES (:id_annonce, :id_owner, :id_user, :etat)";
		$req = $db->prepare($sql);
		$req->execute(array(':id_annonce' => $id_annonce, ':id_owner' =>$id_owner,':id_user' => $id_user, ':etat'=>$etat));
		$result = $req->fetchAll(PDO::FETCH_ASSOC);
		echo 'Votre demande d intérêt à bien été envoyée';
		return true;

	}
	catch (PDOException $e){
		print 'Erreur PDO : '.$e->getMessage().'<br/>';
		die();
	}
} */


function signalerAnnonce($id_annonce, $id_owner, $id_user){
	/* envoi de mail aux admins en donner l'id de l'annonce, du createur de l'annonce
	et la personne qui l'a signalée */
}

function sendMail($email, $fname, $lname, $subject, $content, $returnText){
	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;                               	// Enable verbose debug output

	$mail->isSMTP();                                      	// Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  						// Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               	// Enable SMTP authentication
	$mail->Username = 'dd.iim.year2@gmail.com';             // SMTP username
	$mail->Password = 'TRk41Q[poXdF-725_aQ*)/6';            // SMTP password
	$mail->SMTPSecure = 'ssl';                           	// Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;                                   	// TCP port to connect to



	$mail->setFrom('from@example.com', 'Inscription Share your work');
	$mail->addAddress($email, $fname.' '.$lname); 	// Add a recipient

	$mail->isHTML(true);                                  	// Set email format to HTML
	$mail->Subject = $subject;
	$mail->Body    = $content;
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	if(!$mail->send()) {
		$_SESSION['flash'] = $mail->ErrorInfo;
		return false;
	    //echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		$_SESSION['flash'] = $returnText;
		return true;
	}
}