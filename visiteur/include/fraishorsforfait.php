                 <!--Mise en place du tableau-->
<table class="table table-bordered shadow">
    <thead class="thead">
        <tr>
            <th class="tableau">Libellé</th>
            <th class="tableau">Date du frais</th>
            <th class="tableau">Montant</th>
            <th class="tableau">Date de Saisie</th>
            <th class="tableau">Justificatif</th>
            <th class="tableau">Modification</th>
            <th class="tableau">Suppression</th>
        </tr>
    </thead>

    <tbody>
        <?php 
        //Declaration des variable
        $idVisiteur = $_SESSION['id'];
        $dateDay = date('m');
        $totauxFHF = 0;
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
        //requete pour aller cherche la ligne correspondant
        $reqLigne = $bdd->prepare('SELECT * FROM LigneFraisHorsForfait WHERE idFichefrais = :idFichefrais');
        $reqLigne->execute(array(
            ':idFichefrais'=>$idFichefrais));
        //boucle pour afficher toutes le slignes
        while($resLigne = $reqLigne->fetch()){
            //Mise au bont format de la date
            $date = date('d-m-Y', strtotime($resLigne["date"]));
            $dateSaissie = date('d-m-Y', strtotime($resLigne['dateSaissie']));
            //mise en forme des variables
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
                    <td>
                        <form id='modif' method='post' action='modiffierFrais.php'>
                            <input type='hidden' name='id' value=".$idLigneFraisHorsForfait.">
                            <input type='hidden' name='frais' value='horsforfait'>
                            <input type='submit' class='btn btn-warning btnMenu shadow' id='Modiffier' name='Modiffier' value='Modiffier' >
                    </td>
                    <td>
                            <input type='hidden' name='id' value=".$idLigneFraisHorsForfait.">
                            <input type='hidden' name='frais' value='horsforfait'>
                            <input type='submit' class='btn btn-danger btnMenu shadow' id='Supprimer' name='Supprimer' value='Supprimer'>
                        </form>
                    </td>
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