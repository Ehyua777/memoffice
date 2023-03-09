<h1 class="title">Ajouter un Modérateur</h1>
<br clear="all">
<form method="post" action="<?php $config->rp() ?>">
<?php if (isset($message)) { ?>
<fieldset><?php echo $message ?></fieldset>
<?php } ?>
<fieldset>
<input type="text" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email'] ?>" placeholder="Email du modérateur">
</fieldset>
<fieldset><input type="submit" name="modo" value="Affecter"></fieldset>
</form>