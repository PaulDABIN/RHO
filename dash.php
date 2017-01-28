<?php

session_start();
require 'config/config.php';
require 'model/functions.fn.php';
require 'model/flash.php';
require ('template/_header.php');
require ('template/dash.php');



filtrageAnnonce($db); //ne pas lancer la fonction filtrage sinon bug
//car il manque des composants dans la bdd.




if (isset($_POST['intéressé'])){
    $id_annonce =  $_POST['id_annonce'];
    $id_user = $_SESSION['id'];
    $id_owner =  $_POST['id_owner'];
    $etat =  'demande';
    interet($db, $id_annonce, $id_user, $id_owner, $etat);
};
/*if (isset($_POST['supprimer'])){
    $id_annonce =  $_POST['id_annonce'];
    $id_user = $_SESSION['id'];
    suppressionAnnonce($db, $id_annonce , $id_user);
};
if (isset($_POST['signaler'])){
    $id_annonce =  $_POST['id_annonce'];
    $id_owner =  $_POST['id_owner'];
    $id_user = $_SESSION['id'];
    signaler($id_annonce, $id_owner, $id_user);
}; */


?>
    </div></div>
<?php

require ('template/_footer.php');

?>