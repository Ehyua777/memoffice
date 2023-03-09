<div id="banner">
<img src="<?php ROOTPATH ?>/templates/default/img/icons/home.png" width="16" height="16" /> &raquo; <strong><a href="<?php ROOTPATH ?>/members"><?php echo $pageTitle ?></a></strong>
<?php
$userManager = new UserManager($db);
if (isset($_GET['m']))
{
	$memberId=(int)$_GET['m'];
	$member=$userManager->setUser($memberId);
	?>
    &nbsp;&raquo;&raquo;&nbsp;
    <strong>
    <a href="<?php ROOTPATH; ?>/members/?m=<?php echo $memberId; ?>">
	<?php echo $member->pseudo(); ?>
    </a>
    </strong>
    <?php
}
else
{
	?>
    &nbsp;&raquo;&raquo;&nbsp;
	<strong><?php echo $pseudo; ?></strong>
	<?php
}
?>
</div>