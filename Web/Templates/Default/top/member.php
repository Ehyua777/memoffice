<?php if ($visitor->isAuthenticated()){?>
<?php
$userManager = new LLibrary\Models\UserManager($db);
$member = $userManager->setAUser($id);
?>
<ul class="nivo1">
<li>
<a href="<?php $config->rp() ?>/members">
<img src="/Web/loads/img/avators/<?php echo $member->avator() ?>" class="avator" title="<?php $member->pseudo() ?>" />
</a>
<ul class="nivo2">
<?php
if (LLibrary\Entities\User::checkAccessRights(LLibrary\Entities\User::ADMIN))
{
	?>
    <li>
    <a href="<?php $config->rp() ?>/untitled">
    PANEAU
    </a>
    </li>
    <?php
}
elseif (LLibrary\Entities\User::checkAccessRights(LLibrary\Entities\User::ADMIN))
{
	?>
    <li>
    <a href="<?php $config->rp() ?>/memoffice">
    ADMIN
    </a>
    </li>
    <?php
}
else
{
	?>
    <li>
	<?php echo '<a href="'.$config->rp().'/members">'.$pseudo.'</a>';?>
    </li>
    <?php
    }
?>
  <li>
<?php echo '<a href="'.$config->rp().'/members/?mp=edit&amp;cat=sett">Réglages</a>'; ?>
  </li>
  <li>
<a href="<?php $config->rp() ?>/logout">Déconnexion</a>
</li>
</ul>
</ul>
<?php
}
else
{
	include('default.php');
} 
?>