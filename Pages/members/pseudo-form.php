<h1 class="title">Modifier le pseudo</h1>
<br clear="all" />
<form method="post" action="<?php $config->rp() ?>">
<?php if (isset($message)) {?>
<fieldset><?php echo $message; ?></fieldset>
<?php } ?>
<fieldset>
<input type="text" name="pseudo" value="<?php echo $member->pseudo() ?>" placeholder="Nouveau pseudo" />
</fieldset>
<fieldset>
<input type="submit" name="editpseudo" value="Modifier" />
<input type="reset" value="Reprendre" />
</fieldset>
</form>