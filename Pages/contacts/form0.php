<h2 class="title">Formulaire de contact</h2>
<form method="post" action="<?php $config->rp() ?>" name="form">
<?php if (isset($message))
{
	?>
    <fieldset class="error-message"><?php echo $message ?></fieldset>
    <?php
}
?>
<fieldset>
<table width="100%" border="0" cellspacing="5" cellpadding="5">
  <tr>
    <td align="left">
    <label for="pseudo">Votre pseudo</label>
    </td>
    <td align="left">
    <input type="text" name="pseudo" id="pseudo" value="<?php 
	if (isset($_POST['pseudo'])) echo $_POST['pseudo'] 
	?>" placeholder="Laissez-nous un pseudo">
    <span class="error-message"></span>
    </td>
  </tr>
  <tr>
    <td align="left">
    <label for="email">Votre email</label>
    </td>
    <td align="left">
    <input type="text" name="email" id="email" value="<?php if (isset($_POST['email'])) 
	echo $_POST['email'] ?>" placeholder="Votre e-mail">
    <span class="error-message"></span>
    </td>
  </tr>
  <tr>
    <td align="left">
    <label for="subject">Votre sujet</label>
    </td>
    <td align="left">
    <input type="text" name="subject" id="subject" value="<?php 
	if (isset($_POST['subject'])) echo $_POST['subject'] 
	?>" placeholder="Sujet" />
    <span class="error-message"></span>
    </td>
  </tr>
</table>
<input type="text" name="test" placeholder="Signature" id="test" />
</fieldset>
<?php require('../../Templates/text-java.php'); ?>
<fieldset>
<label for="content">Entrez ici votre message</label>
<textarea name="content" id="content" placeholder="Laissez ici votre message">
<?php if (isset($_POST['content'])) echo $_POST['content'] ?>
</textarea>
<span class="error-message"></span>
</fieldset>
</fieldset>
<fieldset>
<input type="submit" name="contact" value="Envoyer" id="contact" />
<input type="reset" value="Reprendre" />
</fieldset>
</form>