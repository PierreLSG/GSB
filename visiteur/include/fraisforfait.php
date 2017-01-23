         <!--Mise en place du tableau-->
<table class="table table-bordered shadow">
    <thead class="thead">
        <tr>
            <th class="tableau">Libellé</th>
            <th class="tableau">Date du frais</th>
            <th class="tableau">Quantité</th>
            <th class="tableau">Montant unitaire</th>
            <th class="tableau">Total</th>
            <th class="tableau">Date de Saisie</th>
            <th class="tableau">Modification</th>
            <th class="tableau">Suppression</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //Declaration des variable
        $idVisiteur = $_SESSION['id'];
        $dateDay = date('m');
        $totauxFF = 0;
        $day = date('d');
        $idEtat = "2";
        if($day <= 10){
            $dateDay = date('m', strtotime("-1 month",strtotime(date('Y-m-d'))));
        }
    

        //Recupération de la bonne FicheFrais
        $reqFiche = $bdd->prepare('SELECT id, dateModif FROM FicheFrais WHERE MONTH(dateFrais) = :dateFrais AND idVisiteur = :idVisiteur AND idEtat = :idEtat');
        $reqFiche->execute(array(
            ':dateFrais'=>$dateDay,
            ':idVisiteur'=>$idVisiteur,
            ':idEtat'=> $idEtat));
        $resFiche = $reqFiche->fetch();
        //mise en forme des variables
        $idFichefrais = $resFiche['id'];
        $dateModif = $resFiche['dateModif'];

        //recupére toute les ligne correspondant à la fiche
        $reqLigne = $bdd->prepare('SELECT * FROM LigneFraisForfait WHERE idFichefrais = :idFichefrais');
        $reqLigne->execute(array(
            ':idFichefrais'=>$idFichefrais));
        //Boucle pour afficher toute les ligne
        while($resLigne = $reqLigne->fetch()){
            //mise en forme des variables
            $idLigneFraisForfait = $resLigne['id'];
            $idFraisForfait = $resLigne['idFraisForfait'];


            //Requette pour le libéllé du FraisForfait
            $reqLibelle = $bdd->prepare('SELECT libelle, montant FROM FraisForfait WHERE id = :idFraisForfait');
            $reqLibelle->execute(array(
                ':idFraisForfait'=>$idFraisForfait));
            $resLibelle = $reqLibelle->fetch();
            
            //mise en forme des variable du tableau
            //libelle
            $libelle = $resLibelle["libelle"];
            //dates
            $mois = date('d-m-Y', strtotime($resLigne["mois"]));
            $date = date('d-m-Y', strtotime($resLigne['date']));
            $montant = $resLibelle['montant'];
            $quantite = $resLigne['quantite'];
            //total
            $total = $quantite * $montant;
        
            //Affichage des info dans le tableau
            echo "<tr>
                   <td>".$libelle."</td>
                   <td>".$mois."</td>
                   <td>".$quantite."</td>
                   <td>".$montant."</td>
                   <td class='text-right'>".$total."</td>
                   <td>".$date."</td>
                   <td>
                       <form id='modif' method='post' action='modiffierFrais.php'>
                           <input type='hidden' name='id' value=".$idLigneFraisForfait.">
                           <input type='hidden' name='frais' value='forfait'>
                           <input type='submit' class='btn btn-warning btnMenu shadow' id='Modiffier' name='Modiffier' value='Modiffier' >
                    </td>
                    <td>
                            <input type='hidden' name='id' value=".$idLigneFraisForfait.">
                            <input type='hidden' name='frais' value='forfait'>
                            <input type='submit' class='btn btn-danger btnMenu shadow' id='Supprimer' name='Supprimer' value='Supprimer'>
                        </form>
                    </td>
                 </tr>";   
            //Calcule des totaux
            $totauxFF = $totauxFF + $total;       
        }

    ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4" class="text-right tableau" >Total :</th>
            <th class='text-right'><?php echo $totauxFF ?> €</th>
            <th colspan="2" ></th> 
        </tr>
    </tfoot>
</table>   