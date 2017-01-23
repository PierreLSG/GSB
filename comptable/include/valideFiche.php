<?php
	
if(isset($_GET['id']) && !empty($_GET['id'])){
	//mise en forme des variables
	$idVisiteur = strip_tags($_GET['id']);
	$idEtat = "1";
	//requete pour aller chercher ndas la bdd la fiche qui correspond au visiteur
	$reqFiche = $bdd->prepare('SELECT id FROM fichefrais WHERE idVisiteur = :idVisiteur AND idEtat = :idEtat');
	$reqFiche->execute(array(
		':idVisiteur'=> $idVisiteur,
		':idEtat'=> $idEtat));
	$resFiche = $reqFiche->fetch();
	//mise en forme des variable 
	$idFichefrais = $resFiche['id'];
?>
     <div class="row contentDate">
        <div class="col-md-12 text-center DateStyle">
            <br>
        </div>
    </div>
    <section class="container-fluid" id="forfait">
        <br>
        <h1>Frais au forfait :</h1>
		<table class="table table-bordered">
            <thead class="thead">
                <tr>
                    <th class="tableau">Libellé</th>
                    <th class="tableau">Date du frais</th>
                    <th class="tableau">Quantité</th>
                    <th class="tableau">Montant unitaire</th>
                    <th class="tableau">Total</th>
                    <th class="tableau">Date de Saisie</th>
                    <th class="tableau">Valider</th>
                    <th class="tableau">Modification</th>
                    <th class="tableau">Validation</th>
                </tr>
            </thead>
            <tbody>
<?php
                //Declaration des variable
                $totauxFF = 0;
                 //recupére toute les ligne correspondant à la fiche
                $reqLigne = $bdd->prepare('SELECT * FROM LigneFraisForfait WHERE idFichefrais = :idFichefrais');
                $reqLigne->execute(array(
                    ':idFichefrais'=>$idFichefrais));
                //boucle pour afficher toute les ligne frais forfait
                while($resLigne = $reqLigne->fetch()){
                    $idLigneFraisForfait = $resLigne['id'];
                    $idFraisForfait = $resLigne['idFraisForfait'];
                    $date = $resLigne['date'];

                    //Requette pour le libéllé du FraisForfait
                    $reqLibelle = $bdd->prepare('SELECT * FROM FraisForfait WHERE id = :idFraisForfait');
                    $reqLibelle->execute(array(
                        ':idFraisForfait'=>$idFraisForfait));
                    $resLibelle = $reqLibelle->fetch();
                    
                    //mise en forme des variable du tableau
                    //libelle
                    $libelle = $resLibelle["libelle"];
                    //dates
                    $mois = date('d-m-Y', strtotime($resLigne["mois"]));
                    $date = date('d-m-Y', strtotime($resLigne['date']));
                    $quantite = $resLigne['quantite'];
                    $montant = $resLibelle['montant'];
                    //total
                    $total = $quantite * $montant;
                    //valider
                    $valider = $resLigne['valider'];
                    //Affichage des info dans le tableau
                    echo "<tr>
                           <td>".$libelle."</td>
                           <td>".$mois."</td>
                           <td>".$quantite."</td>
                           <td>".$montant."</td>
                           <td class='text-right'>".$total."</td>
                           <td>".$date."</td>
                           <td>";
                                if($valider == "1"){
                                    
                                    echo "<form id='modif' method='post' action='../ttt/annuligne.php'>
                                            <span class='glyphicon glyphicon-ok'></span>
                                            <input type='hidden' name='id' value=".$idLigneFraisForfait.">
                                            <input type='hidden' name='idVisiteur' value=".$idVisiteur.">
                                            <input type='hidden' name='frais' value='forfait'>
                                            <input type='submit' class='btn btn-danger btnMenu shadow' id='Annuler' name='AnnulerFrais' value='Annuler'>
                                          </form>";

                                }
                                if($valider == "0"){
                                    echo "<span class='glyphicon glyphicon-remove'></span></p>";
                                }
                    echo " </td>
                           <td>
                               <form id='modif' method='post' action='modiffierFrais.php'>
                                   <input type='hidden' name='id' value=".$idLigneFraisForfait.">
                                   <input type='hidden' name='idVisiteur' value=".$idVisiteur.">
                                   <input type='hidden' name='frais' value='forfait'>
                                   <input type='submit' class='btn btn-warning btnMenu shadow' id='Modiffier' name='Modiffier' value='Modiffier' >
                                </form>
                            </td>";
                    echo "<td>
                                <form id='modif' method='post' action='../ttt/valideligne.php'>
                                    <input type='hidden' name='id' value=".$idLigneFraisForfait.">
                                    <input type='hidden' name='idVisiteur' value=".$idVisiteur.">
                                    <input type='hidden' name='frais' value='forfait'>
                                    <input type='submit' class='btn btn-success btnMenu shadow' id='Valider' name='ValiderFrais' value='Valider'>
                                </form>
                            </td>
                         </tr>";
                     //Calcule des totaux
                     if($valider == "1"){
                        $totauxFF = $totauxFF + $total; 
                    }    
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-right tableau">Total :</th>
                    <th class='text-right'><?php echo $totauxFF ?> €</th>
                    <th colspan="2" ></th> 
                </tr>
            </tfoot>
        </table>
    </section>
    <div class="row contentDate">
        <div class="col-md-12 text-center DateStyle">
        <br>
            <?php
            //requete pour aller chercher les commentaires
            $reqCommentaire = $bdd->prepare('SELECT * FROM commentaire WHERE idFichefrais = :idFichefrais AND idVisiteur = :idVisiteur');
            $reqCommentaire->execute(array(
                ':idFichefrais'=>$idFichefrais,
                ':idVisiteur'=>$idVisiteur));
            $resCommentaire = $reqCommentaire->fetch();
            echo "<p>Commentaire : ".$resCommentaire["commentaire"]."</p>";

            ?>
        </div>
    </div>
    <section class="container-fluid" id="forfait">
        <br>
        <h1>Frais hors forfait :</h1>
		<table class="table table-bordered">
            <thead class="thead">
                <tr>
                    <th class="tableau">Libellé</th>
                    <th class="tableau">Date du frais</th>
                    <th class="tableau">Montant</th>
                    <th class="tableau">Date de Saisie</th>
                    <th class="tableau">Justificatif</th>
                    <th class="tableau">Valider</th>
                    <th class="tableau">Modification</th>
                    <th class="tableau">Validation</th>
                </tr>
            </thead>
            <tbody>
<?php 
            //Declaration des variable
			$totauxFHF = 0;
            $nbJustificatif = 0;
            $reqLigne = $bdd->prepare('SELECT * FROM LigneFraisHorsForfait WHERE idFichefrais = :idFichefrais');
            $reqLigne->execute(array(
                ':idFichefrais'=>$idFichefrais));
            //boucle pour aller chercher toutes les lignes hors forfait
            while($resLigne = $reqLigne->fetch()){
                //Mise au bont format de la date
                $date = date('d-m-Y', strtotime($resLigne["date"]));
                $dateSaissie = date('d-m-Y', strtotime($resLigne['dateSaissie']));
                //mise en forme des variabeles
                $libelle = $resLigne["libelle"];
                $montant = $resLigne["montant"];
                $idLigneFraisHorsForfait = $resLigne['id'];
                $justificatif = $resLigne["justificatif"];
                //condition pour savoir si il y a un justificatif

                $valider = $resLigne['valider'];
                if(!empty($resLigne["justificatif"]) && $valider == "1"){

                    $nbJustificatif++;
                }
                //Affichage des info dans le tableau
                echo "<tr>
                        <td>".$libelle."</td>
                        <td>".$date."</td>
                        <td class='text-right'>".$montant." €</td>
                        <td>".$dateSaissie."</td>
                        <td><a href='../uploads/".$justificatif."'>".$justificatif."</a></td>
                        <td>";
                            if($valider == "1"){
                                 echo "<form id='modif' method='post' action='../ttt/annuligne.php'>
                                            <span class='glyphicon glyphicon-ok'></span>
                                            <input type='hidden' name='id' value=".$idLigneFraisHorsForfait.">
                                            <input type='hidden' name='idVisiteur' value=".$idVisiteur.">
                                            <input type='hidden' name='frais' value='forfait'>
                                            <input type='submit' class='btn btn-danger btnMenu shadow' id='Annuler' name='AnnulerFraisHF' value='Annuler'>
                                          </form>";
                            }
                            if($valider == "0"){
                                echo "<span class='glyphicon glyphicon-remove'></span>";
                            }
                echo " </td>
                        <td>
                           <form id='modif' method='post' action='modiffierFrais.php'>
                                <input type='hidden' name='id' value=".$idLigneFraisHorsForfait.">
                                <input type='hidden' name='idVisiteur' value=".$idVisiteur.">
                                <input type='hidden' name='frais' value='horsforfait'>
                                <input type='submit' class='btn btn-warning btnMenu shadow' id='Modiffier' name='Modiffier' value='Modiffier' >
                            </form>
                        </td>
                        <td>
                            <form id='modif' method='post' action='../ttt/valideligne.php'>
                                <input type='hidden' name='id' value=".$idLigneFraisHorsForfait.">
                                <input type='hidden' name='idVisiteur' value=".$idVisiteur.">
                                <input type='hidden' name='frais' value='horsforfait'>
                                <input type='submit' class='btn btn-success btnMenu shadow' id='Valider' name='ValiderFraisHF' value='Valider'>
                            </form>
                        </td>
                      </tr>";
                if($valider == "1"){
                    $totauxFHF = $totauxFHF + $montant; 
                }                  
            }
?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th colspan="2" class="text-right tableau">Total :</th>
	                <th class='text-right'><?php echo $totauxFHF ?> €</th>
	                <th colspan="2" ></th> 
	            </tr>
	        </tfoot>
	    </table>
	</section>


<?php
    $totaux = $totauxFF + $totauxFHF ?>
    <div class="row contentDate">
        <div class="col-md-12 text-center DateStyle">
            <h4> Total des frais de la fiche: <?php echo $totaux ?> €</h4>
            <?php 
                echo "
                    <form id='modif' method='post' action='../ttt/validerFicheVisiteur.php'>
                        <input type='hidden' name='nbJustificatif' value=".$nbJustificatif.">
                        <input type='hidden' name='montant' value=".$totaux.">
                        <input type='hidden' name='idFichefrais' value=".$idFichefrais.">
                        <input type='hidden' name='frais' value='forfait'>
                        <input type='submit' class='btn btn-success btnMenu shadow' id='Valider' name='Valider' value='Valider la fiche'>
                    </form><br>";
            ?>
        </div>
    </div>
<?php
}