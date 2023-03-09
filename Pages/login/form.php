<div class="post">
<h1 class="title">Connexion</h1>
<div class="entry">
<form method="post" action="<?php $config->rp() ?>">
<?php if (isset($message)){ ?>
<fieldset><?php echo $message; unset($message); ?></fieldset>
<?php } ?>
<fieldset>
<label for="email">Email</label>
<input type="text" name="email" id="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" placeholder="Votre adresse e-mail">
<label for="pw">Mot de passe</label><input type="password" name="pw" id="pw" value="<?php if (isset($_POST['pw'])) echo $_POST['pw']; ?>" placeholder="Votre mot de passe">
</fieldset>
<fieldset>
<label>Se souvenir de moi ?</label><input type="checkbox" name="rememberMe" value="ok" />
</fieldset>
<fieldset>
<input type="submit" name="login" value="Connexion">
<input type="reset" value="Reprendre" />
</fieldset>
</form>
<?php ?>
<p class="byline"><small>Vous n'estes pas inscri ?&nbsp;
<a href="<?php $config->rp() ?>/inscription" id="inscription">Inscription</a></small></p>
</div>
</div>