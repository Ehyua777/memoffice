<?php
$okpages = array(
'home' => 'controller1.php',
'comp' => 'controller2.php',
'avat' => 'controller3.php',
'pass' => 'controller4.php',
'pseu' => 'controller5.php',
'emai' => 'controller6.php',
'sign' => 'controller8.php'
);
if ((isset($_GET['mp'])) && (isset($okpages[$_GET['mp']])))
{
	include($okpages[$_GET['mp']]);
}
else
{
	include('controller1.php');
}
?>