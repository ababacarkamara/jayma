 <?php 
	session_start();// Démarrer la session
?>
<html>
	<head>
		<meta charset="utf-8" />
		<link href="style.css" type="text/css" rel="stylesheet"/>
	</head
	<body>
			<?php
			if(isset($_SESSION["login"]))
			{?>
				<h3>Commande:</h3>
				<?php 
					$id_client=$_SESSION["id"];
					$id_produit=$_GET['id'];
					$quantite=$_GET["quantite"];
					$connect=mysql_connect('localhost','root','vieux5223')or die('Erreure connexion ');
					mysql_select_db('jayma');
					$requete="Select * from produit WHERE IdProduit=$id_produit";
					$req="Select * from utilisateur where IdUser=$id_client";
					if($res=mysql_query($req))
					{
						$lign = mysql_fetch_array($res);
						
						
					}	
					if ($resultat=mysql_query($requete))
					{
						$ligne = mysql_fetch_array($resultat);
					}
			?>
			<div class="prod">
			<table>
				<tr>
					<td>Nom:</td>
					<td><?php echo ($lign["Prenom"]." ".$lign["Nom"]);?>
					</td>
				</tr>
				<tr>
					<td>Adresse:</td>
					<td><?php echo ($lign["Adresse"])?></td>
				</tr>
				<tr>
					<td>Téléphone:</td>
					<td><?php echo ($lign["Telephone"])?></td>
				</tr>
				<tr>
					<td>Designation:</td>
					<td><?php echo ($ligne["Designation"])?></td>
				</tr>
				<tr>
					<td>Prix Unitaire:</td>
					<td><?php echo (($ligne["Prix"]- ($ligne["Prix"]*$ligne["Remise"])/100))?></td>
				</tr>	
				<tr>
					<td>Quantité:</td>
					<td>
						<?php echo ($quantite)?>
					</td>
				</tr>
				<tr>
					<td>
						<form <input method="post" action="">
							<p><input type="submit"  value="Confirmer commande" name="submit"></p>
						</form>
					</td>
				</tr>
			</table>
			</div>
					
			<?php } else{?>
					Vous n'etes pas encore connecté!
		<?php }
		?>
	</body>
</html>