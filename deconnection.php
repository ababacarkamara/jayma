<?php
session_start();// D�marrer la session

session_destroy();
header("Location:index.php?msg=Vous venez de vous deconnecter");
?>