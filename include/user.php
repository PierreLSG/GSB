<br>
<table class="table table-bordered shadow">
    <thead class="thead">
        <tr>
            <th class="tableau">Nom</th>
            <th class="tableau">Prenom</th>
            <th class="tableau">Login</th>
            <th class="tableau">Fonction</th>
            <th class="tableau">Action</th>
        </tr>
    </thead>
    <tbody>
<?php
include('bdd.php');
$reqUser = $bdd->prepare('SELECT * FROM visiteur');
$reqUser->execute(array(
	':id'=> $_SESSION['id']));
while($resUser = $reqUser->fetch()){
    	echo "<tr>
	            <td>".$resUser['nom']."</td>
	            <td>".$resUser['prenom']."</td>
	            <td>".$resUser['login']."</td>";
	            if($resUser['idFonction'] == "1"){
	            	echo "<td>Admin</td>";
	        	}
	        	if($resUser['idFonction'] == "2"){
	            	echo "<td>Visiteur</td>";
	        	}
	        	if($resUser['idFonction'] == "3"){
	            	echo "<td>Comptable</td>";
	        	}
	        	if($_SESSION['id'] != $resUser['id']){
		            echo "<td>
	                         <a href='../ttt/suprUtili.php?id=".$resUser['id']."' class='btn-floating waves-effect waves-light red'><i class='material-icons'>delete</i></a>
	                    	<a href='editUser.php?id=".$resUser['id']."' class='btn-floating waves-effect waves-light blue darken-4'><i class='material-icons'>mode_edit</i></a>
	                              </td>
		        </tr>";}else{
		        	echo "<td>
		        			<a href='editUser.php?id=".$resUser['id']."' class='btn-floating waves-effect waves-light blue darken-4'><i class='material-icons'>mode_edit</i></a>
	                        </td>
		        </tr>";

		        }
}?>
    </tbody>
    <tfoot>
    	<tr>
            <th class="tableau">Nom</th>
            <th class="tableau">Prenom</th>
            <th class="tableau">Login</th>
            <th class="tableau">Fonction</th>
            <th class="tableau">Action</th>
        </tr>
    </tfoot>
</table>