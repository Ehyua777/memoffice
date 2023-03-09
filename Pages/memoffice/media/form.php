<h1 class="title">Gestion de videos</h1>
<form action="<?php $config->rp() ?>" enctype="multipart/form-data" method="post" name="form">
<?php if (isset($message) && !empty($message)){ ?>
<fieldset><?php echo $message ?></fieldset>
<?php } ?>
<fieldset>
<label for="title">Titre de la video</label>
<input type="text" name="title" id="title" value="" placeholder="Mettez ici le titre de votre vidéo" />
<label for="src">Source</label>
<input type="url" name="src" id="src" value="" placeholder="Le lien menant à la video" />
<label for="poster">Posteur</label>
<input type="file" name="poster" id="poster" />
<label for="type">Type de la video</label>
<select name="type" id="type">
<option value="speach">DISCOURS</option>
<option value="report">REPORTAGES</option>
<option value="column">CHRONIQUES</option>
<option value="interview">ENTREVUES</option>
</select>
</fieldset>
<fieldset>
<?php include('../../../memoffice/Templates/text-java.php'); ?>
<legend>Commentaire</legend>
<textarea name="content" placeholder="Saisir ici le commentaire sur la video"></textarea>
</fieldset>
<fieldset>
<input type="submit" name="newvideo" value="Poster" />
<input type="reset" value="Cancel" />
</fieldset>
</form>