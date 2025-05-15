<?php
require '../config.php'; session_start();
if(empty($_SESSION['cart'])){ header('Location:../../recherche.html');exit;}
$_SESSION['cart']=[]; header('Location:../../index.html?success=paiement');exit;
