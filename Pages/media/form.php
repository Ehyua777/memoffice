<form method="post" action="<?php $config->rp() ?>" name="form">
<?php include('../../Templates/text-java.php'); ?>
<fieldset><legend>Votre commentaire</legend>
<textarea name="content" placeholder="Laissez ici votre commentaire"></textarea>
<input type="hidden" name="video" value="<?php echo $video->id() ?>" />
</fieldset>
<fieldset>
<input type="submit" name="videocomment" value="Poster" />
<input type="reset" value="Reprendre" />
</fieldset>
</form>