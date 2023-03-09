<?php
$okpages = array (
'visi' => 'controller0.php',
'anno' => 'controller1.php'
				 );
if ((isset($_GET['cp'])) && (isset($okpages[$_GET['cp']])))
{
	include($okpages[$_GET['cp']]);
}
else
{
	include('controller0.php');
}
?>