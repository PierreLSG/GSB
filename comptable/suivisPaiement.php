<?php
//fichier qui permet de faire la verification sur les utilisateurs
include("include/verification.php");
?>
<!DOCTYPE html>
<html lang="en">
<!--Inclusion du head-->
<?php include('../include/head.php') ?>
  <body>
  	<header class="container-fluid">
        <div class="row">
            <div class="col-md-2">
              <br>
              <a href="index.php"><img class="img-responsive" src="../image/logo.png" alt="LogoLaboratoireGSB"></a>
            </div>
            <div class="col-md-8 col-md-offset-2">
              <h1 class="title"> Application Gestion de Frais </h1>
            </div>
            <div class="col-md-8 col-md-offset-0">
              <div class="btn-group btn-group-justified">
                <a href="index.php" class="btn btn-default btnMenu shadow">Validation des fiches</a>
                <a href="suivisPaiement.php" class="btn btn-default btnMenu shadow">Suivis paiement fiches de frais</a>
                <a href="profile.php" class="btn btn-default btnMenu shadow">Profile</a>
                <a href="../include/deconnexion.php" class="btn btn-default btnMenu shadow">Deconnexion</a>
              </div>
              <br>
            </div>
        </div>
    </header>
    <div class="container" id="containerMain">
    <?php
    $idEtat = "4";
    $reqFiche = $bdd->prepare('SELECT * FROM fichefrais WHERE idEtat = :idEtat');
    $reqFiche->execute(array(
      ':idEtat'=> $idEtat));
    ?>
    	<section class="container-fluid" id="forfait">
        <br>
        <table class="table table-bordered">
          <thead class="thead">
              <tr>
                  <th class="tableau">Nom</th>
                  <th class="tableau">Prenom</th>
                  <th class="tableau">Montant</th>
                  <th class="tableau">Date de la fiche</th>
                  <th class="tableau">remboursée</th>
              </tr>
          </thead>
          <tbody>
            <?php
            while($resFiche = $reqFiche->fetch()){
              //mise en forme des variable
              $idVisiteur = $resFiche['idVisiteur'];
              $montant = $resFiche['montantValide'];
              $date = date('d-m-Y', strtotime($resFiche['dateFrais']));
              $etat = $resFiche['idEtat'];
              //requete pour aller chercher le nom et le prénom de la personne
              $reqVisiteur = $bdd->prepare('SELECT nom, prenom FROM visiteur WHERE id = :idVisiteur');
              $reqVisiteur->execute(array(
                ':idVisiteur'=> $idVisiteur));
              $resVisiteur = $reqVisiteur->fetch();
              //mise en forme des variable
              $nom = $resVisiteur['nom'];
              $prenom = $resVisiteur['prenom'];

              echo "<tr>
                      <td>".$nom."</td>
                      <td>".$prenom."</td>
                      <td>".$montant."</td>
                      <td>".$date."</td>";
                      if($etat == "3"){
                        echo "<td><span class='glyphicon glyphicon-ok'></span></td>";
                      }else{
                        echo "<td><span class='glyphicon glyphicon-remove'></span></td>";
                      }
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>

      </section>

      <div class="row contentDate">
      </div>

      <section class="container-fluid" id="horsForfait">
      </section>
    </div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="../js/jquery.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed --> 
    <script src="../js/bootstrap-datepicker.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script type="text/javascript">
	$('.sandbox-container .input-group.date').datepicker({
    });
	</script>
    <!--Inclusion du footer-->
    <?php include('../include/footer.php'); ?>
  </body>
</html>