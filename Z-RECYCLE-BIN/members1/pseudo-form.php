<h1 class="title">Modifier le pseudo</h1>
<br clear="all" />
<form method="post" action="<?php ROOTPATH; ?>">
<?php if (isset($echo)) {?>
<fieldset><?php echo $echo; ?></fieldset>
<?php } ?>
<fieldset>
<legend>Pseudo</legend>
<input type="text" name="pseudo" value="<?php echo $member['pseudo'] ?>" placeholder="Nouveau pseudo" />
</fieldset>
<fieldset>
<input type="submit" value="Modifier" />
<input type="reset" value="Reprendre" />
</fieldset>
</form>