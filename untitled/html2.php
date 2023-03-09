<h1 class="title">Ajouter un Administrateur</h1>
<br clear="all">
<form method="post" action="<?php $config->rp() ?>">
<?php if (isset($message)) { ?>
<fieldset><?php echo $message ?></fieldset>
<?php } ?>
<fieldset>
<input type="text" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email'] ?>" placeholder="Email de l'administrateur">
</fieldset>
<fieldset><input type="submit" name="admin" value="Affecter"></fieldset>
</form>