<?php
$pageTitle='Photos';
require ('../../LLibrary/lumbrera.required.php');
$photoManager = new LLibrary\Models\PhotoManager($db);
include('../../Templates/layout.php');
?>