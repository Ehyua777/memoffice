<?php
if (isset($_SERVER['REDIRECT_URL']))
{
	if (preg_match('#blog-([0-9-]+)\.html#isU', $_SERVER['REDIRECT_URL'], $match))
	{
		/*Modification du code retour, pour que les moteurs de recherche indexent nos 
		pages !*/
		header("Status: 200 OK", false, 200);
		header('location:'.$config->rp().'/blog');
	}
	else
	{
		require('404.php');
	}

}
else
{
	require('404.php');
}
?>