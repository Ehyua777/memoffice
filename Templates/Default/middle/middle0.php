<?php 
if ($pageTitle == 'Bienvenu' || $pageTitle == 'Home')
{
	include('Pages/home/middle.php');
}
else
{
	include('middle.php');
}
?>