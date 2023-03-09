<?php
$okpages = array(
'news' => 'news.php',
'arti' => 'articles.php',
'repo' => 'reports.php'
);
if ((isset($_GET['page'])) && (isset($okpages[$_GET['page']])))
{
 include ($okpages[$_GET['page']]);
}
else
{
	include ('news.php');
}
?>
