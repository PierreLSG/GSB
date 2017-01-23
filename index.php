<?xml version="1.0" encoding="ISO-8859-1"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Gestion Frais</title>
<link rel="stylesheet" href="css/cssSIO.css">
<!-- Bootstrap -->
<link href="css/bootstrap.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body id="bodyMain">
<div class="container-fluid" id="mainContainer">
  <div class="row" id="logContent">
    <div class="col-md-1" id="colForm">
   	  <form class="form-inline" role="form" id="formLOG" action="index.php" method="post">
      <div class="form">
       	<img src="image/logo.png" class="img-responsive" alt="Placeholder image" id="logoLOG">
        
		<h1 id="TitleForm"> Conection / Login</h1>
    		<label for="text">Login</label>
            <br>
    		<input type="text" class="form-control" name="login"> 
            <br>
            <label for="password">Mot de passe</label>
            <br>
       		<input type="password" class="form-control" name="mdp">
                <br>
                <br>
                <br>
            <button type="submit" id="buttonvalid" name="connection" value="connection">Connexion</button>
            </div>
    </form>
    </div>
  </div>
  <?php include("include/connexion.php") ?>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="../../Documents/unpySite/js/jquery-1.11.3.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="../../Documents/unpySite/js/bootstrap.js"></script>
<script src="JS/fction.js"></script>
<script type="text/javascript"> 
	attrHeight('#bodyMain');
</script>
</body>
</html>
