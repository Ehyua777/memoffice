<?php
$snooz = $videoManager->count();
$subjectsNunberPerPage=32;
$pagesNumber = ceil($snooz/$subjectsNunberPerPage);
if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p']<= $pagesNumber)
{
	$runningPage=$_GET['p'];
}
else
{
	$runningPage=1;
}
$offset1 = ($runningPage-1)*$subjectsNunberPerPage;
$limit1  = $subjectsNunberPerPage;
?>