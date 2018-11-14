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
			include('entete.php');
			if(isset($_REQUEST['msg']))
			echo $_REQUEST['msg'];
			if(isset($_REQUEST["login"])){
				$lg = $_REQUEST["login"];
				$mdp = $_REQUEST["pwd"];	
				if($id=mysqli_connect("localhost","root","vieux5223","jayma"))
				{
						$mdpencrypt = md5($mdp);
						$requete = "select * from utilisateur where Login='$lg' and MotDePasse='$mdp';";
						if($resultat=mysqli_query($id, $requete)){
							if(mysqli_num_rows($resultat)==0)
								header("Location:index.php?msg=Login ou mdp incorrect!");
							else{
								$ligne = mysqli_fetch_array($resultat);
								if($ligne["TypeUser"]==1)
								{	
									session_start();
									$_SESSION["id"]=$ligne["IdUser"];
									$_SESSION["login"]=$lg;
									$_SESSION["adrIP"]=$_SERVER['HTTP_HOST'];
									header("Location:admin.php?msg=Vous etes connecte en tant que administrateur ");
								}
								else
								{
									session_start();
									$_SESSION["login"]=$lg;
									$_SESSION["id"]=$ligne["IdUser"];
									$_SESSION["adrIP"]=$_SERVER['HTTP_HOST'];
									header("Location:index.php?msg=Bienvenue ".$_SESSION['login']);
								}
							}
						}else
					header("Location:index.php?msg=Impossible d'executer la requete!");
					
				}else
					header("Location:index.php?msg=Impossible de connecter au serveur de bd!");
			}
		?>
		<div class="bienvenu">
			
		</div>
		<div>
			<?php
			if(isset($_SESSION["login"]))
			{?>
				Connecté en tant que :
				<?php echo ($_SESSION["login"]);?>
				<ul>
					<li id="deconnection"> <a href="deconnection.php"><h4>Se deconnecter</h4></a> </li>
				</ul>
			<?php } else{?>
					 </div>
							<div class="connexion">
								<form <input method="post" action="index.php">
									<p><input type="texte" name="login" placeholder= " Login"><br/> <br/> <p/> 
									<p> <input type="password" name="pwd" placeholder= " Mot de passe"> <br/> <br/><p/> 
									<p> <input type="submit" value="Connexion" name="submit"><p/> 
								</form>
								Pas encore de compte?
								<a href="inscription.php"> <b>Inscrivez-vous</b></a>
							</div>
		<?php }
	
		?>

		<ul class="menu">
				<li> <a href="accueil.php" target="vitrine" title="Page d'accueil"> <b>Accueil </a></li>
				<li> <a href="promo.php" target="vitrine" title="Produits en promotions"> <b>Promotions </b> </a></li>
				<li> <a href="nouveaux.php" target="vitrine" title="Nouveaux produits"><b> Nouveautés </b> </a></li>
				<li> <a href="conditions.php" target="vitrine" title="Nos conditions de vente"> <b>Conditions de vente </b></a></li>
		</ul>
		<div class="contenu">

		<ul class="rayons">				
				<li> <a href="alimentation.php" target="vitrine" title="Nos produits alimentaires"> Alimentation </a></li>
				<li> <a href="electronique.php" target="vitrine"title="Nos produits électronique"> Electronique </a></li>
				<li> <a href="papeterie.php" target="vitrine" title="Nos produits d'article de bureau et d'études"> Papeterie </a></li>
				<li> <a href="habillement.php" target="vitrine" title="Nos produits vestimentaire"> Habillement </a></li>
				<li> <a href="hygiene.php" target="vitrine" title="Nos produits d'hygiène et de bien-etre"> Hygiène et Beauté </a></li>
		</ul>
			<iframe   name="vitrine" src="accueil.php" width="70%" height="95%">
				<?php 
					include('accueil.php');
				?>	
			</iframe>
		</div> 
		<?php
			include('pied.php');
		?>
	</body>
</html>