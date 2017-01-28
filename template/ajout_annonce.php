<div class="container-fluid">
    <div class="row">
        <div id="annonce">
            <div class="row head">
                <div class="col-md-10 col-md-offset-1">
                    <p><strong>Déposer une annonce sur R.H.O</strong></p>
                </div>
            </div>
            <div class="row banner">
                <h3 class="text-center">Ajouter une annonce</h3>
            </div>
            <div class="row form">
                <div class="col-md-10 col-md-offset-1">
                    <form method="POST" action="ajout_annonce.php" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-border col-md-12">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="codepostal" class="col-sm-2 control-label">Lieu</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="codepostal" class="form-control" id="codepostal" placeholder="votre code postal"required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="departement" class="col-sm-2 control-label">Département</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="dpt" class="form-control" id="departement"  placeholder="votre département" disabled required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jour" class="col-sm-2 control-label">Date</label>
                                    <div class="col-sm-4">
                                        <input type="date" name="dateevent" class="form-control" id="jour" placeholder="la date de l'évènement" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="categorie" class="col-sm-2 control-label">Catégorie</label>
                                    <div class="col-sm-6">
                                        <select name="categorie" class="selectpicker" id="categorie" placeholder="le type d'évènement" required>
                                            <option value="france">France</option>
                                            <option value="belgique">Belgique</option>
                                            <option value="suisse">Suisse</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="titre" class="col-sm-2 control-label">Titre</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="titre" class="form-control" id="titre" placeholder="le titre de l'annonce" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="texte" class="col-sm-2 control-label">Votre annonce</label>
                                    <div class="col-sm-10">
                                        <textarea name="texte" class="form-control" id="texte" placeholder="l'annonce" rows="5" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="col-md-12">
                                    <label for="avatars" class="col-md-12 col-md-offset-0 col-xs-4 col-xs-offset-4">
                                        <p class="text-center" id="file-text">Photo principale</p>
                                        <span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
                                    </label>
                                    <input class="center-block" type="file" name="avatar" id="avatars">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4 col-md-offset-4">
                                    <input type="submit" name="ajout" class="btn btn-block" value="Envoyer" >
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>