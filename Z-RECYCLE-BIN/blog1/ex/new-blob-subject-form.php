<meta charset="utf-8" />
<div id="post">
<h1 class="title">Poster un sujet de blog</h1>
<p>&nbsp;</p>
<form method="post" action="<?php ROOTPATH; ?>" enctype="multipart/form-data">
<fieldset>
<legend>Image du sujet</legend>
<input type="file" name="image" />
</fieldset>
<fieldset>
<input type="text" name="title" placeholder="Titre de news">
<textarea name="bref" placeholder="Le debrif du contenu"></textarea>
<textarea name="text" placeholder="Contenu de news"></textarea>
</fieldset>
<fieldset>
<input type="submit" value="Publier">
<input type="reset" value="réinitialiser">
</fieldset>
</form>
</div>