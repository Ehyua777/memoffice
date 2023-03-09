<?php
$pageTitle='Bienvenu';
require ('‪/../LLibrary/lumbrera.required.php');
$subjectManager = new LLibrary\Models\BlogSubjectManager($db);
$homeManager = new LLibrary\Models\HomeManager($db);
$home = $homeManager->getHomeData(1);
include('Templates/layout.php');
?>