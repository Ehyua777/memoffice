<div class="my-map1">
<div class="my-map2">
<ul class="nav">
<li><img src="/Templates/Default/img/icons/home.png" /></li>
<li>&raquo;&raquo;</li>
<li>
<a href="<?php $config->rp() ?>/members"><?php echo $pageTitle ?></a>
</li>
<?php
if (isset($_GET['m']))
{
	$memberId=(int)$_GET['m'];
	$member=$userManager->setAUser($memberId);
	?>
    &nbsp;&raquo;&raquo;&nbsp;
    <strong>
    <a href="<?php $config->rp() ?>/members/<?php echo $memberId.'/'.$member->alias() ?>">
	<?php echo $member->pseudo() ?>
    </a>
    </strong>
    <?php
}
else
{
	?>
    &nbsp;&raquo;&raquo;&nbsp;
	<strong><?php echo $member->pseudo() ?></strong>
	<?php
}
?>
</ul>
</div>
</div>