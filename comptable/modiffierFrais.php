<?php
//fichier qui permet de faire la verification sur les utilisateurs
include("include/verification.php");
//Condition pour savoir si l'utilisateur veux modifier le frais
if($_POST["Modiffier"]){ 
    ?>
    <!DOCTYPE html>
    <html lang="en">
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
        	<section class="container-fluid" id="forfait">
               <?php include('include/fraisforfait.php') ?>
            </section>

            <section class="container-fluid" id="forfait">
                <?php include('include/fraishorsforfait.php') ?>
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
        <div id="pied_de_page">
        <?php include('../include/footer.php'); ?>
        </div>
      </body>
    </html>
    <?php
//Condition pour savoir si l'utilisateur veux supprimer le frais
}elseif($_POST['Supprimer']){
    //inclusion de la page suprimerfrais
    include('include/suprimerfrais.php');
} 
?>
