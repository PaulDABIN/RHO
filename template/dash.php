<div class="container-fluid">
        <div class="row">
            <div class="col-md-12 filtrage">
                <form method="POST" action="dash.php">
                    <div class="localisation">
                        <div class="col-md-2 col-md-offset-2">
                            <div class="col-md-10">
                                <h4>Localisation</h4>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="postal_code" id="postal_code" placeholder="département">
                            </div>
                            <div class="col-md-10">
                                <input type="text" id="codepostal" name="codepostal" placeholder="code postal">
                            </div>
                        </div>
                    </div>
                    <div class="date">
                        <div class="col-md-2 col-md-offset-1">
                            <div class="col-md-10">
                                <h4>Date</h4>
                            </div>
                            <div class="col-md-10">
                                <input type="date" id="dateevent" name="dateevent" placeholder="date de l evenement" >
                            </div>
                            <div class="col-md-10">
                                <input type="submit"  name="Aujourdhui" value="Aujourd'hui" class="text-right middle" >
                            </div>
                        </div>
                    </div>
                    <div class="sujet">
                        <div class="col-md-2 col-md-offset-1">
                            <div class="col-md-10 localisation">
                                <h4>Catégorie</h4>
                            </div>
                            <div class="col-md-10">
                                <input type="text" id="categorie" name="categorie" placeholder="categorie">
                            </div>

                            <div class="col-md-10 localisation">
                                <h4>Sujet</h4>
                            </div>
                            <div class="col-md-10">
                                <input type="text" id="sujet" name="titre" placeholder="sujet" >
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-9 col-xs-offset-3 column">
                            <input type="submit" value="Envoyer" >
                        </div>
                    </div>

                </form>
            </div>
            <div class="col-md-12 bande">Les annonces</div>