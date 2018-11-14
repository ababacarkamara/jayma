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
		$id=mysql_pconnect("localhost","root","vieux5223") or die(mysql_error());
		$id_bd=mysql_select_db("jayma",$id) or die(mysql_error());
		$requete="Select * from produit where rayon='alimentation';";
		$resultat=mysql_query($requete) or die(mysql_error());?>
		<?php while($ligne = mysql_fetch_array($resultat)){?>
		<div class="prod">
			<table>
				<tr>
					<td>Designation:</td>
					<td><?php echo ($ligne["Designation"])?></td>
					<td rowspan=3 > <img src = "<?php echo ($ligne["Image"])?>" heigth="100px" width="150px" alt="photo"/></td>
				</tr>
				<tr>
					<td>Description:</td>
					<td><?php echo ($ligne["Description"])?></td>
				</tr>
				<tr>
					<td>Prix:</td>
					<td><?php echo (($ligne["Prix"]- ($ligne["Prix"]*$ligne["Remise"])/100))?></td>
				</tr>	
				<tr>
					<td>Stock:</td>
					<td><?php echo ($ligne["Stock"])?></td>
				</tr>
				<tr>
					<td>
					<form <input method="post" action="">
							Quantite <input  type="number_format" name="quantite" >
					</form>
					</td>
					<td><a href='panier.php?id=<?php echo $ligne["IdProduit"]?>&quantite=<?php echo $_GET["quantite"]?>'>Commander</a></td>
				</tr>
			</table>
		</div>
	<?php }?>
	</body>
</html>