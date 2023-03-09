<form method="post" action="<?php ROOTPATH; ?>">
<?php
if (isset($loginMessage))
{
	?>
    <fieldset><?php echo $loginMessage; ?></fieldset>
    <?php
    }
?>
<fieldset>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
    <input type="text" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" placeholder="Votre adresse e-mail">
    </td>
  </tr>
  <tr>
    <td><input type="password" name="pw" value="<?php if (isset($_POST['pw'])) echo $_POST['pw']; ?>" placeholder="Votre mot de passe"></td>
  </tr>
</table>
</fieldset>
<fieldset>
<label>Se souvenir de moi ?</label><input type="checkbox" name="remember" />
</fieldset>
<fieldset>
<input type="submit" value="Connexion">
<input type="reset" value="Reprendre" />
</fieldset>
</form>