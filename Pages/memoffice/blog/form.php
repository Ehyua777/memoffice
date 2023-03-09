<form method="post" action="<?php $config->rp() ?>" enctype="multipart/form-data" name="form">
<?php if (isset($message)) { ?>
<fieldset><?php echo $message ?></fieldset>
<?php }?>
<?php if (isset($errors) && in_array(BlogSubject::INVALID_SENDER, $errors)) { ?>
<fieldset>L'auteur est invalide.</fieldset> 
<?php } ?>
<?php if (isset($errors) && in_array(BlogSubject::INVALID_SENDER, $errors)) { ?>
<fieldset>Le titre est invalide.</fieldset>
<?php } ?>
<?php if (isset($errors) && in_array(BlogSubject::INVALID_TEXT, $errors)) { ?>
<fieldset>Le contenu est invalide.</fieldset>
<?php } ?>
<?php include('../../../memoffice/Templates/text-java.php'); ?>
<fieldset>
<legend>Image du sujet</legend>
<input type="hidden" name="sender" value="<?php echo $visitor->id() ?>" />
<input type="file" name="image" />
</fieldset>
<fieldset>
<input type="text" name="title" value="<?php if (isset($subject)) echo $subject->title(); ?>" placeholder="Titre de news">
<textarea name="content" placeholder="Contenu de news">
<?php if (isset($subject)) echo $subject->text(); ?>
</textarea>
</fieldset>
<?php
if (isset($subject) && $subject->isNew())
{
	?>
    <input type="hidden" name="status" value="1" />
    <fieldset>
    <input type="submit" name="newsubject" value="Publier">
    <input type="reset" value="réinitialiser">
    </fieldset>
	<?php
}
else
{
	?>
    <fieldset>
    <input type="hidden" name="subjectid" value="<?php echo $subject->id(); ?>" />
    <select name="status">
    <option>Action</option>
    <option value="0">Suprimer</option>
    <option value="1">Modifier</option>
    </select>
    </fieldset>
    <fieldset><input type="submit" name="editsubject" value="Modifier" /></fieldset>
    <?php
}
?>
</form>