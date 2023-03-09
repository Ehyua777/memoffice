<h1 class="title">Modifier l'email</h1>
<br clear="all" />
<form method="post" action="<?php ROOTPATH; ?>">
<?php if (isset($echo)) {?>
<fieldset><?php echo $echo; ?></fieldset>
<?php } ?>
<fieldset>
<legend>Pseudo</legend>
<input type="email" name="email" value="<?php echo $member['email'] ?>" placeholder="Nouvel email" />
</fieldset>
<fieldset>
<input type="submit" value="Modifier" />
<input type="reset" value="Reprendre" />
</fieldset>
</form>