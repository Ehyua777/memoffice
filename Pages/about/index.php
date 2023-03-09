<?php
$pageTitle='A propos de MEM';
require ('../../LLibrary/lumbrera.required.php');
$homeManager = new LLibrary\Models\HomeManager($db);
$home = $homeManager->getHomeData(1);
include('../../Templates/layout.php');
?>