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
		 <br/><br/>
		<h2>Supprimer produit</h2>
		<?php 
			if($id=mysql_pconnect("localhost","root","vieux5223"))
			{
				if($id_bd = mysql_select_db("jayma",$id))
				{
					$id=$_GET['id'];
					$supp="DELETE FROM produit WHERE IdProduit=$id";
					$req=mysql_query($supp);
					if($req)
					{
						header("Location:admin.php?msg=Vous avez supprimer le produit avec succes");
					}
					else
					{
						//header("Location:supprimer.php?msg=Une erreure s'est produite!");
					}
				}else
					header("Location:index.php?msg=Impossible de se choisir la bd!");
			}else
				header("Location:index.php?msg=Impossible de se connecter au serveur de bd!");
		?>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	</body>
	<?php
		require_once('pied.php');
	?>
</html>