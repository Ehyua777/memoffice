<?php
if (config\checkAccessRights(MODO))
{
    if (isset($_POST['title']))
	{
		$time = time();
		extract($_POST);
		if (!empty($title))
		{
			$imagename=(!empty($_FILES['image']['size']))?img\move_image($_FILES['image']):'';
			$blogPostReturn=blogBack1\post_blog_subject($title, $bref, $text, $imagename, 
			$id, $time);
			echo $blogPostReturn;
		}
		else
		{
			echo 'Les données n\'ont pas été soumis...';
		}
	}
	include('new-blob-subject-form.php');
}
else
{
	header ('location:'.ROOTPATH.'/error');
}
?>