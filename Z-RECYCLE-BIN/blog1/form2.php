<form method="post" action="<?php ROOTPATH; ?>" name="form">
<?php include('../../Templates/text-java.php'); ?>
<fieldset>
<textarea name="content" placeholder="Laissez ici votre commentaire"></textarea>
<input type="hidden" name="subject" value="<?php echo $subject->id() ?>" />
</fieldset>
<fieldset>
<input type="submit" name="blogcomment" value="Poster" />
<input type="reset" value="Reprendre" />
</fieldset>
</form>