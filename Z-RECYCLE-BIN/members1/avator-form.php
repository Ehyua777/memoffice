<h1 class="title">Modifier l'avatar du profile</h1>
<br clear="all" />
<form method="post" action="<?php ROOTPATH; ?>" enctype="multipart/form-data">
<?php if (isset($echo)) {?>
<fieldset><?php echo $echo; ?></fieldset>
<?php } ?>
<fieldset>
<legend>Avatar</legend>
<img src="<?php ROOTPATH; ?>/web/images/avators/<?php echo $member['../../members/avator'] ?>" />
<br /><br />
<label><strong>Changer votre avatar :(10 ko maximum)</strong></label>
<br />
<input type="file" name="avator" id="avator" />
<br />
<br />
<label for="del"><strong>Supprimer l'avata</strong></label>
<input type="checkbox" name="action" value="del" id="del" />
</fieldset>
<fieldset>
<input type="submit" value="Modifier">
<input type="reset" value="Reprendre">
</fieldset>