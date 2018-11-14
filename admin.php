 <?php
session_start();// Démarrer la session
if(isset($_SESSION["login"]))
		{
			if($id=mysqli_connect("localhost","root","vieux5223","jayma"))
			{					
					$ch="<table>";
					$ch2="<table>";
					$ch.="<tr>
								<td>IdProduit</td>
								<td>Designation</td>
								<td>Description</td>
								<td>Image</td>
								<td>Prix(FCFA)</td>
								<td>Stock</td>
								<td>Rayon</td>
								<td>Modifier</td>
								<td>Supprimer</a></td>
							</tr>";
					$ch2.="<tr>
								<td>IdUser</td>
								<td>Login</td>
								<td>Prenom</td>
								<td>Nom</td>
								<td>Adresse</td>
								<td>Mail</td>
								<td>Telephone</td>
								<td>Supprimer</a></td>
							</tr>";
					$requete="Select * from produit ;";
					$req="Select * from utilisateur where TypeUser=0;";
					if (($resultat=mysqli_query($id, $requete)) &&  ($result=mysqli_query($id, $req)))
					{
						while($ligne = mysqli_fetch_array($resultat)) 
						{
							$IdProduit = $ligne["IdProduit"];
							$Designation = $ligne["Designation"];
							$Description = $ligne["Description"];
							$Image = $ligne["Image"];
							$Prix = $ligne["Prix"];
							$Stock = $ligne["Stock"];
							$Rayon = $ligne["Rayon"];
							$ch.="<tr>
								<td>$IdProduit</td>
								<td>$Designation</td>
								<td>$Description</td>
								<td>$Image</td>
								<td>$Prix</td>
								<td>$Stock</td>
								<td>$Rayon</td>
								<td><a href='modifier.php?id=$IdProduit'>$IdProduit</a></td>
								<td><a href='supprimer.php?id=$IdProduit'>$IdProduit</a></td>
							</tr>";
						}
						$ch.= "</table>";
						while($lign = mysqli_fetch_array($result))
						{
							$idUser = $lign["IdUser"];
							$login = $lign["Login"];
							$prenom = $lign["Prenom"];
							$nom = $lign["Nom"];
							$adresse = $lign["Adresse"];
							$mail=$lign["Mail"];
							$phone = $lign["Telephone"];
							$ch2.="<tr>
								<td>$idUser</td>
								<td>$login</td>
								<td>$prenom</td>
								<td>$nom</td>
								<td>$adresse</td>
								<td>$mail</td>
								<td>$phone</td>
								<td><a href='desinscription.php'>$idUser</a></td>
							</tr>";
						}
						$ch2.= "</table>";
					}else
						header("location:index.php?msg=Impossible d'executer la requete!");
			}else
			header("location:index.php?msg=Impossible de choisir au serveur");	
		}else
			header("Location:index.php?msg=Veuillez vous connecter svp");
?>
<html>
	<body>
	
		<?php 
			include('entete.php');
			if(isset($_SESSION["login"]))
				if(isset($_REQUEST['msg']))
					echo $_REQUEST['msg'];
			else
					header('Location:index.php');

		?>

		<br><br>
		<ul>
			<li id="ajouter"> <a href="ajouter.php"><h4>Ajouter produit</h4></a> </li>
			<li id="deconnection"> <a href="deconnection.php"><h4>Se deconnecter</h4></a> </li>
		</ul>
		<br><br>
		<h2>Table des Produits </h2>
				<?php echo $ch;?>
		<br/>
		<h2>Table des Utilisateurs </h2>
				<?php echo $ch2;?>
		<?php
			include('pied.php');
		?>
	</body>
</html>