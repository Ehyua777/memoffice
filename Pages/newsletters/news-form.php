<h1 class="title">Poster une newsletter</h1>
<br clear="all">
<?php $date = date('d/m/y'); ?>
<form method="post" action="<?php $config->rp() ?>">
<fieldset>
<input type="text" name="title" placeholder="Titre de la news">
<input type="hidden" value="<?php echo $date ?>">
<textarea name="news" placeholder="Poster ici la lettre"></textarea>
</fieldset>
<fieldset>
<input type="submit" value="Poster">
<input type="reset" value="Reprendre">
</fieldset>
</form>