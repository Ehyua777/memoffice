<?php include('page-up.php'); ?>
<?php
$pagesNumber=photoFront1\photo_page_number();
if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p']<= $pagesNumber)
{
	$runningPage=$_GET['p'];
}
else
{
	$runningPage=1;
}
$firstPhoto=photoFront1\photo_offset();
$photos=photoFront1\get_photos($firstPhoto, 9);
foreach($photos as $cle => $photo)
{
	$photos[$cle]['file'] = $photo['file'];
	$photos[$cle]['title'] = stripslashes(htmlspecialchars($photo['title']));
	$photos[$cle]['comment'] = nl2br(stripslashes(htmlspecialchars($photo['comment'])));
}
if (!empty($photos))
{
	foreach($photos as $photo)
	{
		include('photo.php');
	}
}
else
{
	echo 'Pas de photos disponibles';
}
?>
<?php include('pagging.php'); ?>