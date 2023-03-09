<form method="post" action="<?php ROOTPATH; ?>">

<fieldset>
<legend>Identificaton</legend>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><input type="text" name="fname" placeholder="Votre Prénom"></td>
  </tr>
  <tr>
    <td><input type="text" name="name" placeholder="Votre nom"></td>
  </tr>
  <tr>
    <td>
    <select name="genre">
    <option>Genre</option>
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
    <td><input type="datetime" name="day" placeholder="Jour" /></td>
    <td><input type="datetime" name="month" placeholder="Mois" /></td>
    <td><input type="datetime" name="year" placeholder="Année" /></td>
  </tr>
</table>
</fieldset>

<fieldset>
<legend>Contacts</legend>
<input type="text" name="loc" placeholder="Localisation">
<input type="text" name="site" placeholder="Votre site web">
</fieldset>

<fieldset>
<legend>Info supplémentaires</legend>
<textarea name="bio" placeholder="Votre petite biographie"></textarea>
</fieldset>

<fieldset>
<input type="submit" value="Enregistrer">
<input type="reset" value="Reprendre">
</fieldset>

</form>