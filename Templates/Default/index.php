<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require('head-content.php'); ?>
<?php if (isset($layout)) { ?>
<title><?php echo $layout->title() ?></title>
<?php } else { ?>
<title>Untitled document</title>
<?php } ?>
</head>

<body>
<?php require('body-content.php'); ?>
</body>
</html>