<?php
if (isset($_GET['sign']) && $_GET['sign']=='ok')
{
	if(!empty($_POST['email']))
	{
		$newsLetterSignAlert=newsletterFront1\newsletter_sign($_POST['email'], 
		$_POST['new']);
		echo $newsLetterSignAlert;
	}
}
elseif (isset($_GET['sign']) && $_GET['sign']=='ko')
{
	if(!empty($_POST['email']))
	{
		$newsLetterSignAlert=newsletterFront1\newsletter_sign($_POST['email'], 
		$_POST['new']);
		echo $newsLetterSignAlert;
	}
	include('signout.php');
}
elseif(isset($_GET['nla']) && !empty($_GET['true']))
{
	$sesionEmail=$_SESSION['email'];
	$okEmail=$_GET['true'];
	$nla=$_GET['nla'];
	$newsLetterEmailManagerAlert=newsletterFront1\newsletter_email_manager($sesionEmail, 
	$okEmail, $nla);
	echo $newsLetterEmailManagerAlert;
}
elseif (check_access_rights(MODO))
{
	include ('news-form.php');
}
else
{
	header('location:'.ROOTPATH.'/error');
}
?>