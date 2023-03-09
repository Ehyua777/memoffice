<?php if ($visitor->isAuthenticated()){?>
<?php
$userManager = new LLibrary\Models\UserManager($db);
$member = $userManager->setAUser($visitor->id());
?>
<ul class="nivo1">
<li>
<a href="<?php $config->rp() ?>/members">
<?php $member->displayAvator() ?>
</a>
<ul class="nivo2">
<?php if ($visitor->isModerator()) { ?>
<li><a href="<?php $config->rp() ?>/memoffice">ADMIN</a></li>
<?php } ?>
<?php if ($visitor->isAllRightsOne()) {?>
<li><a href="<?php $config->rp() ?>/untitled">PANEAU</a></li>
<?php } else { ?>
<li><?php echo '<a href="'.$config->rp().'/members">'.$member->pseudo().'</a>';?></li>
<?php } ?>
<?php if ($visitor->isWebMaster()) { ?>
<li><a href="<?php $config->rp() ?>/pm">WG space</a></li>
<?php } ?>
<li><a href="<?php $config->rp() ?>/logout">Déconnexion</a></li>
</ul>
</ul>
<?php } else include('default.php'); ?>