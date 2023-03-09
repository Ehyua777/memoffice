<?php
//Selection du dernier sujet posté sur le blog
$lastSubjects = $subjectManager->getList(0, 1);
foreach($lastSubjects as $subject)
{
	if (!empty($lastSubjects))
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
		include('last-blog-post.php');
	}
}
?>