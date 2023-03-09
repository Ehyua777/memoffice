<h1 class="title">Modifier l'email</h1>
<br clear="all" />
<form method="post" action="<?php $config->rp() ?>">
<?php if (isset($message)) {?>
<fieldset><?php echo $message; ?></fieldset>
<?php } ?>
<fieldset>
<input type="email" name="email" value="<?php echo $member->email() ?>" placeholder="Nouvel email" />
</fieldset>
<fieldset>
<input type="submit" name="editemail" value="Modifier" />
<input type="reset" value="Reprendre" />
</fieldset>
</form>