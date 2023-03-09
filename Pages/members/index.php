<?php
$pageTitle='Espace membres';
require ('../../LLibrary/lumbrera.required.php');
$userManager = new LLibrary\Models\UserManager($db);
$member = new LLibrary\Entities\Member();
include('../../Templates/layout.php');
?>