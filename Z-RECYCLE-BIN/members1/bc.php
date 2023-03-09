<?php
$okpages = array(
'prof' => 'controler1.php',
'comp' => 'controler2.php',
'edit' => 'controler3.php',
'modo' => 'controler4.php'
);
if ((isset($_GET['mp'])) && (isset($okpages[$_GET['mp']])))
{
	include($okpages[$_GET['mp']]);
}
else
{
	include('controler1.php');
}
?>
