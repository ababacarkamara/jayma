 <?php 
	session_start();// Démarrer la session
?>

<html>
	<?php 
		include('entete.php');
	?>
	<body>
		<?php 
		 if(isset($_REQUEST['msg']))
			echo $_REQUEST['msg'];
		 ?> 
		 	<h2>Modifier produit</h2><br/><br/>
		 <?php 
			$connect=mysql_connect('localhost','root','vieux5223')or die('Erreure connexion ');
			mysql_select_db('jayma');
			$id=$_GET['id'];
			$requete="Select * from produit WHERE IdProduit=$id";
			if ($resultat=mysql_query($requete)){
				{
					$ligne = mysql_fetch_array($resultat);
					$idProduit = $ligne["IdProduit"];
					$designation = $ligne["Designation"];
					$description = $ligne["Description"];
					$image = $ligne["Image"];
					$prix = $ligne["Prix"];
					$remise = $ligne["Remise"];
					$stock = $ligne["Stock"];
					$rayon = $ligne["Rayon"];
				}
			}
		 ?>	
		<form class="modifier" method="post" action="">
			
			<br />Designation<br />
			<input  value="<?php echo $designation?>" type="text" name="designation"/> 
			<br />Description<br />
			<textarea name="description" rows="3" cols="50"> <?php echo $description?> </textarea>
			<br />Image<br />
			<input type="text" name="image" value="<?php echo $image?>" /> 
			<br />Prix<br />
			<input type="number_format" name="prix" value="<?php echo $prix?>" /> 
			<br />Remise<br />
			<input type="number_format" name="remise" value="<?php echo $remise?>">
			<br />Stock<br />
			<input type="number_format" name="stock" value="<?php echo $stock?>" />  
			<br />Rayon<br /> 
			<select name="rayon" value="<?php echo $rayon?>" > 
				<option value="alimentation"> Alimentaire </option>
				<option value="electronique" > Electronique </option>
				<option value="papeterie"> Papeterie </option>
				<option value="habillement" > Habillement </option>
				<option value="hygiene"> Hygiène et Beauté </option>
			</select>     <br /><br />
			  <br /><br />
			<input type="submit" value="Modifier" name="submit"><br/><br />
		</form>
		<?php 
			if(isset($_POST["submit"]))
			{
				$designation = $_POST["designation"];
				$description = $_POST["description"];
				$image = $_POST["image"];
				$prix = $_POST["prix"];
				$remise = $ligne["Remise"];
				$stock = $_POST["stock"];
				$rayon=$_POST["rayon"];
				if($designation&&$image&&$prix&&$stock&&$rayon)
				{
							$connect=mysql_connect('localhost','root','vieux5223')or die('Erreure connexion ');
							mysql_select_db('jayma');
							$modif="UPDATE produit 
									SET Designation='$designation', Description='$description', Image='$image', Prix='$prix', Remise='$remise', Stock='$stock',Rayon='$rayon' 
									WHERE IdProduit=$id";
							$req=mysql_query($modif);
							if($req)
							{
								if(isset($_REQUEST['msg']))
									echo $_REQUEST['msg'];
								header("Location:admin.php?msg=Vous avez modifie le produit avec succes");
								
							}
				}else
					echo"Veuillez remplir tous les champs";
			}
		?>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	</body>
	<?php
		require_once('pied.php');
	?>
</html>