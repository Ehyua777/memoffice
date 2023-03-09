<form method="post" action="<?php ROOTPATH; ?>" enctype="multipart/form-data">
<fieldset>
<legend>Photo à afficher</legend>
<table width="100%">
  <tr>
    <td>
    <input type="text" name="title" placeholder="Titre de la photo" value="">
    </td>
  </tr>
  <tr>
    <td>
    <input type="file" name="photo" />
    </td>
  </tr>
  <tr>
    <td>
	<?php
    if (isset($photoAlert['error']))
	{
		?>
        <strong><?php echo $photoAlert['error']; ?></strong>
        <?php
	}
	else
	{
		?>
		<strong>(Taille maximalle : 55Ko)</strong>
        <?php
	}
	?>
    </td>
  </tr>
</table>
<textarea name="comment" placeholder="Commentaire sur la photo"></textarea>
</fieldset>
<fieldset>
<input type="hidden" name="id" value="photo">
<input type="submit" value="Poster">
<input type="reset" value="Reprendre">
</fieldset>
</form>