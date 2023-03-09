<?php
$okpages = array(
'subj' => '../selected-subject.php',
'comm' => 'controler2.php',
'mana' => 'controler3.php'
);
if ((isset($_GET['bp'])) && (isset($okpages[$_GET['bp']])))
{
	include($okpages[$_GET['bp']]);
}
else
{
	include('../selected-subject.php');
}
?>