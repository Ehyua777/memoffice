<form method="post" action="<?php $config->rp() ?>" enctype="multipart/form-data" name="form">
<fieldset>
<?php
    if (isset($photoAlert['error']))
	{
		?>
        <strong style="color:rgba(255,0,0,1)">
		<?php echo $photoAlert['error']; ?>
        </strong>
        <?php
	}
	else
	{
		?>
		<strong>(Taille maximalle de la photo : 55Ko)</strong>
        <?php
	}
	?>
</fieldset>
<fieldset><input type="file" name="photo" /></fieldset>
<fieldset>
<input type="text" name="title" placeholder="Titre de la photo" value="">
</fieldset>
<fieldset>
<?php include('../../../memoffice/Templates/text-java.php'); ?>
<textarea name="content" placeholder="Commentaire sur la photo"></textarea>
</fieldset>
<fieldset>
<input type="submit" name="photo" value="Poster">
<input type="reset" name="" value="Reprendre">
</fieldset>
</form>