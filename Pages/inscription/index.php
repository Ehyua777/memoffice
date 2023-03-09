<?php
$pageTitle='Inscription';
require ('../../LLibrary/lumbrera.required.php');
$userManager = new LLibrary\Models\UserManager($db);
include('../../Templates/layout.php');
?>