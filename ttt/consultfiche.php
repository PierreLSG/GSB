<?php
include('../include/bdd.php');
	
if(isset($_POST['mois']) && !empty($_POST['mois'])){
    //mise en forme des variable
	$dates = strip_tags($_POST['mois']);
    $idVisiteur = $_SESSION['id'];
    //Requette qui vas chercher la bonne fiche frais
	$reqfiche = $bdd->prepare('SELECT id FROM FicheFrais WHERE MONTH(dateFrais) = MONTH(:dateFrais) AND YEAR(dateFrais) = YEAR(:dateFrais) AND idVisiteur = :idVisiteur');
	$reqfiche->execute(array(
		'dateFrais'=>$dates,
        ':idVisiteur'=>$idVisiteur));
	$resfiche = $reqfiche->fetch();
	//Mise en variable de l'id de la fiche
	$idFichefrais = $resfiche['id'];
?>
    <div class="row contentDate">
        <div class="col-md-12 text-center DateStyle">
            <br>
        </div>
    </div>
    <section class="container-fluid" id="forfait">
        <br>
        <h1>Frais au forfait :</h1>
		<table class="table table-bordered shadow">
            <thead class="thead">
                <tr>
                    <th class="tableau">Libellé</th>
                    <th class="tableau">Date du frais</th>
                    <th class="tableau">Quantité</th>
                    <th class="tableau">Montant unitaire</th>
                    <th class="tableau">Total</th>
                    <th class="tableau">Date de Saisie</th>
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
                //boucle pour afficher toute les ligne
                while($resLigne = $reqLigne->fetch()){
                    $idFraisForfait = $resLigne['idFraisForfait'];
                    //Requette pour le libéllé du FraisForfait
                    $reqLibelle = $bdd->prepare('SELECT * FROM FraisForfait WHERE id = :idFraisForfait');
                    $reqLibelle->execute(array(
                        ':idFraisForfait'=>$idFraisForfait));
                    $resLibelle = $reqLibelle->fetch();
                    //mise en forme des variable du tableau
                    $libelle = $resLibelle["libelle"];
                    $mois = date('d-m-Y', strtotime($resLigne["mois"]));
                    $date = date('d-m-Y', strtotime($resLigne['date']));
                    $quantite = $resLigne['quantite'];
                    $montant = $resLibelle['montant'];
                    $total = $quantite * $montant;
                    //Affichage des info dans le tableau
                    echo "<tr>
                           <td>".$libelle."</td>
                           <td>".$mois."</td>
                           <td>".$quantite."</td>
                           <td>".$montant."</td>
                           <td class='text-right'>".$total."</td>
                           <td>".$date."</td>
                         </tr>";
                         //Calcule des totaux
                        $totauxFF = $totauxFF + $total; 
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
            //requete pour aller chercher les commentaire
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
		<table class="table table-bordered shadow">
            <thead class="thead">
                <tr>
                    <th class="tableau">Libellé</th>
                    <th class="tableau">Date du frais</th>
                    <th class="tableau">Montant</th>
                    <th class="tableau">Date de Saisie</th>
                    <th class="tableau">Justificatif</th>
                </tr>
            </thead>
            <tbody>
<?php 
            //Declaration des variable
            $idVisiteur = $_SESSION['id'];
			$totauxFHF = 0;
			//Recupération de la bonne FicheFrais
            $reqfiche = $bdd->prepare('SELECT id FROM FicheFrais WHERE MONTH(dateFrais) = MONTH(:dateFrais) AND YEAR(dateFrais) = YEAR(:dateFrais) AND idVisiteur = :idVisiteur');
			$reqfiche->execute(array(
				'dateFrais'=>$dates,
                ':idVisiteur'=>$idVisiteur));
			$resfiche = $reqfiche->fetch();
			//Mise en variable de l'id de la fiche
			$idFichefrais = $resfiche['id'];
            //requete pour aller chercher les ligne hors forfait
            $reqLigne = $bdd->prepare('SELECT * FROM LigneFraisHorsForfait WHERE idFichefrais = :idFichefrais');
            $reqLigne->execute(array(
                ':idFichefrais'=>$idFichefrais));
            //boucle pour afficher les ligne hors forfait
            while($resLigne = $reqLigne->fetch()){

                //Mise au bont format de la date
                $date = date('d-m-Y', strtotime($resLigne["date"]));
                $dateSaissie = date('d-m-Y', strtotime($resLigne['dateSaissie']));
                $libelle = $resLigne["libelle"];
                $montant = $resLigne["montant"];
                $idLigneFraisHorsForfait = $resLigne['id'];
                $justificatif = $resLigne["justificatif"];
                //Affichage des info dans le tableau
                echo "<tr>
                        <td>".$libelle."</td>
                        <td>".$date."</td>
                        <td class='text-right'>".$montant." €</td>
                        <td>".$dateSaissie."</td>
                        <td>".$justificatif."</td>
                      </tr>";
                      $totauxFHF = $totauxFHF + $montant;  
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
        </div>
    </div>
<?php
}
?>
    