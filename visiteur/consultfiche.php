<?php
//inclusion de la page vérification
include('include/verification.php');
?>
<!DOCTYPE html>
<html lang="fr">
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
                  <a href="index.php" class="btn btn-default btnMenu shadow">Saisie de Frais</a>
                  <a href="consultfiche.php" class="btn btn-default btnMenu shadow">Consultation des fiches</a>
                  <a href="profile.php" class="btn btn-default btnMenu shadow">Profile</a>
                  <a href="../include/deconnexion.php" class="btn btn-default btnMenu shadow">Deconnexion</a>
                </div>
                <br>
            </div>
        </div>
    </header>
    
<?php
    //inclusion de mois.php
    include('include/mois.php')
?>
    <div class="container" id="containerMain">
       <section class="container-fluid" id="forfait">
            <form id="mois" method="post" action="consultfiche.php">
                <div class="row">
                    <div class="col-md-12">
                    <br>
                        <div class="col-md-2">
                            <label for="selectCat">Choisissez un mois:</label>
                        </div>
                        <div class="form-group col-md-6">
                            <select class="form-control shadow" name="mois">
                                <?php
                                    echo'
                                    <option value='.$mois01.'>'.$mois1.'</option>
                                    <option value='.$mois02.'>'.$mois2.'</option>
                                    <option value='.$mois03.'>'.$mois3.'</option>
                                    <option value='.$mois04.'>'.$mois4.'</option>
                                    <option value='.$mois05.'>'.$mois5.'</option>
                                    <option value='.$mois06.'>'.$mois6.'</option>
                                    <option value='.$mois07.'>'.$mois7.'</option>
                                    <option value='.$mois08.'>'.$mois8.'</option>
                                    <option value='.$mois09.'>'.$mois9.'</option>
                                    <option value='.$mois010.'>'.$mois10.'</option>
                                    <option value='.$mois011.'>'.$mois11.'</option>
                                    <option value='.$mois012.'>'.$mois12.'</option>
                                    <option value='.$mois013.'>'.$mois13.'</option>';
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-md-offset-6">
                        <input type="submit" class="btn btn-success shadow" name="envoi" value="Valider"/>
                        <a href="consultfiche.php" class="btn btn-danger shadow">Annuler</a>
                    </div>
                </div>
            </form> 
            <br>
        </section>
        <?php include('../ttt/consultfiche.php') ?>
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
    <?php include('../include/footer.php'); ?>
  </body>
</html>