<meta charset="utf-8" />
<h1 class="title">Modifier vos informations générales</h1>
<br clear="all" />
<form method="post" action="<?php ROOTPATH; ?>" enctype="multipart/form-data">
<?php if (isset($echo)) {?>
<fieldset><?php echo $echo; ?></fieldset>
<?php } ?>
<fieldset>
<legend>Identifiant</legend>
<strong>Pseudo :</strong>&nbsp;<strong><?php echo $member['pseudo'] ?></strong>
</fieldset>

<fieldset>
<legend>Info générales</legend>
<label for="fn">Prénom</label>
<input type="text" name="fname" value="<?php echo $member['fname']; ?>" id="fn" />
<label for="n">Nom</label>
<input type="text" name="name" value="<?php echo $member['name']; ?>" id="n" />
</fieldset>

<fieldset>
<legend>Coordonnées</legend>
<label for="loc">Localisation</label>
<input type="text" name="loc" value="<?php echo $member['loc']; ?>" placeholder="localisation" id="loc" />
<label for="web">Site internet</label>
<input type="text" name="web" value="<?php echo $member['website']; ?>" placeholder="Votre site web" />
</fieldset>

<fieldset>
<legend>Signature :</legend>
<textarea name="signature" id="signature">
<?php echo $member['signature'] ?>
</textarea>
</fieldset>

<fieldset>
<legend>Biographie :</legend>
<textarea name="bio" placeholder="Biographie du membre" id="bio">
<?php echo $member['bio'] ?>
</textarea>
</fieldset>

<input type="hidden" name="sent" value="1" />
<fieldset>
<input type="submit" value="Modifier" />
</fieldset>

</form>