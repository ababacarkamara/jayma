<?php 
	session_start();// Démarrer la session
?>

<html>
	<?php 
		require_once('entete.php');
	?>
	<body>
		
		<h2>Formulaire d'inscription</h2>
		<br><br>
		<form class="ajouter" method="post" action="">
			Login<br><input type="name" name="login" placeholder="Login"> <br>Prénom<br>
			<input type="name" name="prenom" placeholder="Prénom"> <br>Nom<br>
			<input type="name" name="nom" placeholder="Nom"> <br>Adresse<br>
			<input type="text" name="adresse" placeholder="Adresse">  <br>Telephone<br>
			<input type="number_format" name="phone" placeholder="Telephone "> <br>Adresse email<br>
			<input type="mail" name="mail" placeholder="Adresse email">  <br>Mot de passe<br>
			<input type="password" name="mdp" placeholder="Mot de passe">    <br>Confirmer mot de passe<br>
			<input type="password" name="confirmermdp" placeholder= "Confirmer mot de passe">  <br><br>
			<input type="submit" value="S'inscrire" name="submit"><br><br>
		</form>
		<?php 
		if(isset($_POST["submit"]))
			{
				$login = $_POST["login"];
				$prenom = $_POST["prenom"];
				$nom = $_POST["nom"];
				$adresse = $_POST["adresse"];
				$phone = $_POST["phone"];
				$mail=$_POST["mail"];
				$mdp=$_POST["mdp"];
				$confirmermdp=$_POST["confirmermdp"];
				if($login&&$prenom&&$nom&&$adresse&&$phone&&$mail&&$mdp&&$confirmermdp)
				{
					if($mdp==$confirmermdp)
					{
							$connect=mysql_connect('localhost','root','vieux5223')or die('Erreure connexion ');
							mysql_select_db('jayma');
							$encryptmdp = md5($mdp);
							$inserer="INSERT INTO utilisateur (Login,Prenom,Nom,Adresse,Mail,Telephone,MotDePasse) 
									VALUES('$login','$prenom','$nom','$adresse','$mail',$phone,'$encryptmdp')";
							$req=mysql_query($inserer);
							if($req)
							{
								$_SESSION["login"]=$lg;
								$_SESSION["adrIP"]=$_SERVER['HTTP_HOST'];
								header("Location:index.php?msg=Vous etes inscrit avec succes");
							}
					}else
						echo"Mots de passe différents";
				}else
					echo"Veuillez remplir tous les champs";
			}
		?>
		<br><br><br><br><br><br><br><br>
	</body>
	<?php
		require_once('pied.php');
	?>
</html>	
