<?php
$pageTitle='Connexion';
require ('../../LLibrary/lumbrera.required.php');
$userManager = new LLibrary\Models\UserManager($db);
include('../../Templates/layout.php');
?>