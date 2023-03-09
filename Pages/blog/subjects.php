<h2>Liste des 5 derniers billets du blog</h2>
<hr>
<?php
include('pages-calculator1.php');
foreach ($subjectManager->getList($offset, $limit) as $subject)
{
	if (strlen($subject->text()) <= 200)
	{
		$content = new LLibrary\General\Content($subject->text());
	}
	else
	{
		$text = substr($subject->text(), 0, 200);
		$text = substr($text, 0, strrpos($text, ' ')).'...';
		$content = new LLibrary\General\Content($text);
	}
	include('listing.php');
}
if ($pagesNumber > 0)
{
	include('pages1.php');
}