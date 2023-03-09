<table id="banner" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php include('hello.php'); ?></td>
    <td align="center">
	<?php
	$newsManager = new LLibrary\Models\NewsManager_PDO($db);
    $news = $newsManager->getInfo();
	foreach($news as $cle => $new)
	{
		$news[$cle]['content'] = stripslashes(htmlspecialchars($new['content']));
		$news[$cle]['date'] = $new['date'];
	}
	foreach($news as $new)
	{
		include('notice.php');
	}
	?>
    </td>
    <td align="right"><?php include('search.php'); ?></td>
  </tr>
</table>
