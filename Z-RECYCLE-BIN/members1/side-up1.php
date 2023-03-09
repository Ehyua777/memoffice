<li>
<h2>Menu espace membre</h2>
<ul>
	<li>
    <a href="<?php ROOTPATH; ?>/members">
    Consulter son profile</a>
    </li>
    <?php if ($member->id()==$id) { ?>
    <?php if (empty($member->fName)) { ?>
    <li><a href="<?php ROOTPATH; ?>/members/?mp=comp">Modifier son profile</a></li>
    <?php } else { ?>
    <li><a href="<?php ROOTPATH; ?>/members/?mp=comp">Completer son profile</a></li>
    <?php } ?>
    <li>
    <a href="<?php ROOTPATH; ?>/members/?mp=pass">Modifier le mot passe</a>
	</li>
    <li>
    <a href="<?php ROOTPATH; ?>/members/?mp=pseu">Modifier le pseudo</a>
	</li>
    <?php if ($member->avator()=='default_avator.png') { ?>
    <li>
    <a href="<?php ROOTPATH; ?>/members/?mp=avat">Choisir l'avatar</a>
    </li>
    <?php } else { ?>
    <li>
    <a href="<?php ROOTPATH; ?>/members/?mp=avat">Modifier l'avatar</a>
    </li>
    <?php } ?>
    <li>
    <a href="<?php ROOTPATH; ?>/members/?mp=emai">Modifier l'email</a>
    </li>
    <?php } ?>
</ul>
</li>