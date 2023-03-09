<?php
$okpages = array(
'home' => 'controler1.php',
'admi' => 'controler2.php'
);
if ((isset($_GET['pp'])) && (isset($okpages[$_GET['pp']])))
{
	include($okpages[$_GET['pp']]);
}
else
{
	include('controler1.php');
}
?>