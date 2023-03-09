<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" type="image/x-ico" href="/Web/images/icons/mem.png" />
<?php if (isset($layout)) { ?>
<title><?php echo $layout->title() ?></title>
<?php } else { ?>
<title>Untitled document</title>
<?php } ?>
<?php
if ($refresh==true)
{
	if(isset($_GET['true']) && !empty($_GET['true']))
	{
		?>
        <meta http-equiv="refresh" content="1; url=<?php echo $config->rp() ?>" />
        <!-- Redirection vers la page d'accueil du site si on a entré son e-mail. -->
		<?php
    }
	else
	{
		?>
        <meta http-equiv="refresh" content="20; url=<?php echo $config->rp() ?>" />
        <!-- Redirection vers la page d'accueil si on tarde trop à entrer son e-mail. -->
		<?php
    }
}
?>
<link rel="stylesheet" type="text/css" href="/Templates/Default/css/controller1.css" />
<link rel="stylesheet" type="text/css" href="/Templates/Default/css/layout.css"/>
<link rel="stylesheet" type="text/css" href="/Templates/Default/css/permanently.css"/>
<link rel="stylesheet" type="text/css" href="/Templates/Default/css/photo.css"/>
<link rel="stylesheet" type="text/css" href="/Templates/Default/css/slimbox2.css"/>
<script type="text/javascript" src="/Templates/Default/js/portfolio/slimbox2.js"></script>
<script type="text/javascript" src="/Templates/Default/js/portfolio/jquery.min.js"></script>
<script src="/Templates/js/jquery-dualslider/jquery.dualSlider.0.3.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/Templates/js/l_bbcode.js"></script>
</head>
<body>
<div id="container1">
<div id="container2">
<header id="haut">
<?php include('headline.php'); ?>
<hr />
<?php include('banner.php'); ?>
</header>
<?php include('menu1.php'); ?>