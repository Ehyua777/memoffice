<form method="post" action="<?php $config->rp() ?>" name="form">
<fieldset>
<legend>Identificaton</legend>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
    <input type="text" name="fName" value="<?php echo $member->fName() ?>" placeholder="Votre Prénom"></td>
  </tr>
  <tr>
    <td><input type="text" name="name" value="<?php echo $member->name() ?>" placeholder="Votre nom"></td>
  </tr>
  <tr>
    <td>
    <select name="genre">
    <option value="HOMME">Homme</option>
    <option value="FEMME">Femme</option>
    </select>
</td>
  </tr>
  </table>
</fieldset>

<fieldset>
<legend>Date de naissance</legend>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
    <input type="number" name="day" value="<?php echo $member->birthDay() ?>" placeholder="Jour" /></td>
    <td><input type="number" name="month" value="<?php echo $member->birthMonth() ?>" placeholder="Mois" /></td>
    <td><input type="number" name="year" value="<?php echo $member->birthYear() ?>" placeholder="Année" /></td>
  </tr>
</table>
</fieldset>

<fieldset>
<legend>Contacts</legend>
<input type="text" name="localisation" value="<?php echo $member->localisation() ?>" placeholder="Localisation">
<input type="text" name="website" value="<?php echo $member->website() ?>" placeholder="Votre site web">
</fieldset>

<fieldset>
<legend>Biographie du membre</legend>
<?php include('../../Templates/text-java.php'); ?>
<textarea name="content" placeholder="Votre petite biographie">
<?php echo $member->bio() ?>
</textarea>
</fieldset>

<fieldset>
<input type="submit" name="updatemember" value="Enregistrer">
<input type="reset" value="Reprendre">
</fieldset>

</form>