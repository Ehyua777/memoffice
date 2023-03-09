<?php
$okpages = array(
'poem' => 'controler1.php',
'book' => 'controler2.php'
);
if ((isset($_GET['op'])) && (isset($okpages[$_GET['op']])))
{
	include($okpages[$_GET['op']]);
}
else
{
	include('content.php');
}
?>