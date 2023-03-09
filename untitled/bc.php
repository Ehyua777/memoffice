<?php
$okpages = array(
'modo' => 'controller1.php',
'admi' => 'controller2.php'
);
if ((isset($_GET['up'])) && (isset($okpages[$_GET['up']])))
{
	include($okpages[$_GET['up']]);
}
else
{
	include('home.php');
}
?>