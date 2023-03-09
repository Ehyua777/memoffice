<?php
$okpages = array(
'righ' => 'members/controller.php',
'subj' => 'blog/controller.php',
'nlet' => 'newslet/controller.php',
'phot' => 'photos/controller.php',
'news' => 'news/controller.php',
'medi' => 'media/controller.php'
);
if ((isset($_GET['ap'])) && (isset($okpages[$_GET['ap']])))
{
	include($okpages[$_GET['ap']]);
}
else
{
	include('content.php');
}
?>