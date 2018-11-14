<?php
session_start();// Démarrer la session

session_destroy();
header("Location:index.php?msg=Vous venez de vous deconnecter");
?>