<h1 class="title">Modifier l'avatar</h1>
<br clear="all" />
<form method="post" action="<?php $config->rp() ?>" enctype="multipart/form-data">
<fieldset>
<?php
if (isset($avatorAlert['error']))
{
	?>
    <strong style="color:rgba(255,0,0,1)"><?php echo $avatorAlert['error']; ?></strong>
	<?php
}
else
{
	?>
    <label><strong>Changer votre avatar :(10 ko maximum)</strong></label>
	<?php
}
?>
</fieldset>
<fieldset>
<div align="center">
<img src="/Web/loads/img/avators/<?php echo $member->avator(); ?>" title="<?php echo $member->pseudo(); ?>" />
</div>
</fieldset>
<fieldset>
<div align="center"><input type="file" name="avator" /></div>
</fieldset>
<fieldset>
<div align="center">
<label for="del"><strong>Supprimer l'avata</strong></label>
<input type="checkbox" name="action" value="del" />
</div>
</fieldset>
</fieldset>

<fieldset>
<input type="submit" name="avator" value="Modifier" />
<input type="reset" value="Reprendre" />
</fieldset>
</form>