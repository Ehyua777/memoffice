<h1 class="title">Inscription</h1>
<form method="post" action="<?php $config->rp() ?>" enctype="multipart/form-data">
<?php if (isset($message)) { ?><fieldset><?php echo $message ?></fieldset><?php } ?>
<fieldset>
<legend>Identifiants</legend>
<table width="100%">
  <tr>
    <td><label>*</label>
<input id="p" name="pseudo" type="text" value="<?php if (isset($_POST['pseudo'])) echo $_POST['pseudo'] ?>" placeholder="Pseudo (3 à 15 caractères)" />
    </td>
  </tr>
  <?php if (isset($pseudoAlert))
  {
	  ?>
	  <tr>
      <td>
	  <?php echo $pseudoAlert['error']; ?>
      </td>
      </tr>
      <?php
      }
   ?>
</table>

<table width="100%">
  <tr>
    <td>
    <label>*</label>
    <input type="password" name="pw1" value="<?php if (isset($_POST['pw1'])) echo $_POST['pw1'] ?>" placeholder="Mot de passe" />
    </td>
  </tr>
  <tr>
    <td>
<label>*</label>
<input type="password" name="pw2" value="<?php if (isset($_POST['pw2'])) echo $_POST['pw2'] ?>" placeholder="Confirmer le mot de passe" />
</td>
      </tr>
      <tr>
    <td>
	<?php if (isset($pwAlert)) echo $pwAlert['error']; ?>
    </td>
    </tr>
</table>
</fieldset>

<fieldset>
<legend>Contacts</legend>
<table width="100%">
  <tr>
    <td>
<label>*</label>
<input type="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email'] ?>" placeholder="Votre adresse Mail" />
</td>
</tr>
<tr>
    <td><?php if (isset($emailAlert)) echo $emailAlert['error']; ?></td>
  </tr>
</table>
</fieldset>

<fieldset>
<legend>Votre signature</legend>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
    <textarea name="signature" placeholder="La signature est limitée à 200 caractères">
    <?php if (isset($_POST['signature'])) echo $_POST['signature'] ?>
</textarea>
</td>
  </tr>
  <?php if (isset($signatureAlert))
  {
	  ?>
	  <tr>
    <td>
	<?php echo $signatureAlert['error']; ?>
    </td>
  </tr>
  <?php
  }
  ?>
</table>
</fieldset>

<fieldset>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr align="left">
    <td><input type="submit" value="S'inscrire" name="amember" /></td>
    <td><input type="reset" value="Repredre" /></td>
    <td>Les champs précédés d'un (*) sont obligatoires</td>
  </tr>
</table>
</fieldset>
</form>