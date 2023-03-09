<?php
$snooz = $photoManager->count();
$subjectsNunberPerPage = 9;
$pagesNumber = ceil($snooz/$subjectsNunberPerPage);
if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p']<= $pagesNumber)
{
	$runningPage = (int) $_GET['p'];
}
else
{
	$runningPage = 1;
}
$offset = (($runningPage-1)*$subjectsNunberPerPage);
$limit  = $subjectsNunberPerPage;
?>