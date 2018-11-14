<?php 
	session_start();// Démarrer la session
?>

<html>
	<?php 
		include('entete.php');
	?>
	<body>

		 <br/><br/>
		
		<h3>Ajouter un produit</h3>
		<form class="ajouter" method="post" action="" enctype="multipart/form-data" >
			
			<br><br>Designation<br>
			<input type="text" name="designation" > 
			<br>Description<br>
			<textarea name="description" rows="3" cols="50"> </textarea>
			<br>Image<br>
			<input type="file" name="image" > 
			<br>Prix<br>
			<input type="number_format" name="prix" >
			<br>Remise<br>
			<input type="number_format" name="remise" >
			<br>Stock<br>
			<input type="number_format" name="stock" >  
			<br>Rayon<br> 
			<select name="rayon" > <!select name="rayon" multiple>
				<option value="electronique"> Electronique
				<option value="papeterie"> Papeterie
				<option value="alimentation"> Alimentaire
				<option value="habillement" > Habillement
				<option value="hygiene"> Hygiène et Beauté
			</select>     <br><br>
			  <br><br>
			<input type="submit" value="Ajouter" name="submit"><br><br>
		</form>
		<?php 
		if(isset($_POST["submit"]))
			{
				$designation = $_POST["designation"];
				$description = $_POST["description"];
				$prix = $_POST["prix"];
				$remise = $_POST["remise"];
				$stock = $_POST["stock"];
				$rayon=$_POST["rayon"];
				$image = $_FILES["image"]["name"];
				$image_tmp = $_FILES["image"]["tmp_name"];
				if(!empty($image_tmp)){
					$img = explode('.',$image); 
					$img_ext = end($img);
					if(in_array(strtolower($img_ext),array('png','jpeg','jpg'))==false){
						echo "Veuillez inserer une image jpg, jpeg ou png";
					}else{
						$img_size = getimagesize($image_tmp);
						if($img_size['mime']=='image/jpeg'){
							$img_src = imagecreatefromjpeg($image_tmp);
						}else if($img_size['mime']=='image/png'){
							$img_src = imagecreatefrompng($image_tmp);
						}else{
							$img_src = false;
							echo"Veuillez entrer une image valide";
						}
						if($img_src!==false){
							$img_width=200;
							if($img_size[0]==$img_width){
								$image_finale = $img_src;
							}else{
								$new_width[0]=$img_width;
								$new_height[1]=200;
							$image_finale=imagecreatetruecolor($new_width[0],$new_height[1]);
							imagecopyresampled($image_finale,$img_src,0,0,0,0,$new_width[0],$new_height[1],$img_size[0],$img_size[1]);
							}
							imagejpeg($image_finale,'images/'.$image);
							echo "image inserer";
						}
					}
			}else{
					echo "Veuillez inserer une image jpg, jpeg ou png";
				}
				if($designation&&$description&&$prix&&$stock&&$rayon&&remise)
				{
							$connect=mysql_connect('localhost','root','vieux5223')or die('Erreure connexion ');
							mysql_select_db('jayma');
							$photo="images/".$image;
							$inserer="INSERT INTO produit (Designation,Description,Image,Prix,Stock,Rayon,Remise) 
									VALUES('$designation','$description','$photo',$prix,$stock,'$rayon',$remise)";
							$req=mysql_query($inserer);
							if($req)
							{
								if(isset($_REQUEST['msg']))
									echo $_REQUEST['msg'];
								header("Location:ajouter.php?msg=Vous avez ajouter le produit avec succes");
								
							}
				}else
					echo"Veuillez remplir tous les champs";
			}
		?>
		<br/><br/><br/><br/><br/><br/>
	</body>
	<?php
		require_once('pied.php');
	?>
</html>