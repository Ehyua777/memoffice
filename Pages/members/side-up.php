<?php if ($member->alias()=='') header('location:'.$config->rp().'/members'); ?>
<h2>Categories</h2>
   <ul>
      <li>
      <a href="<?php $config->rp() ?>/members">
      Consulter son profile</a>
      </li>
      <?php if ($member->id()==$visitor->id()){?>
      <li>
      <a href="<?php $config->rp() ?>/members/<?php echo $member->alias().'/'.
	  'update-profile' ?>">Completer / modifier son profile</a>
      </li>
      <li>
      <a href="<?php $config->rp() ?>/members/<?php echo $member->alias().'/'.
	  'update-password' ?>">
      Modifier le mot passe</a>
      </li>
      <li>
      <a href="<?php $config->rp() ?>/members/<?php echo $member->alias().'/'.
	  'update-pseudo' ?>">
      Modifier le pseudo
      </a>
      </li>
      <li>
      <a href="<?php $config->rp() ?>/members/<?php echo $member->alias().'/'.
	  'update-avator' ?>">Modifier l'avatar
      </a>
      </li>
      <li>
      <a href="<?php $config->rp() ?>/members/<?php echo $member->alias().'/'.
	  'update-email' ?>">Modifier l'email</a>
      </li>
      <li>
      <a href="<?php $config->rp() ?>/members/<?php echo $member->alias().'/'.
	  'update-signature' ?>">Modifier la signature</a>
      </li>
      <?php } ?>
    </ul>