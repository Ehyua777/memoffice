<form method="post" action="<?php $config->rp() ?>" name="form">
<?php include('/../Templates/text-java.php'); ?>
<?php if (isset($message)) { ?>
<fieldset><?php echo $message ?></fieldset>
<?php } ?>
<?php if (isset($errors) && in_array(News::AUTEUR_INVALIDE, $errors)) { ?>
<fieldset><?php echo 'L\'auteur est invalide.';?></fieldset>
<?php } ?>
<?php if (isset($errors) && in_array(News::TITRE_INVALIDE, $errors)) { ?>
<fieldset><?php echo 'Le titre est invalide.'; ?></fieldset>
<?php } ?>
<fieldset>
<input type="hidden" name="author" value="<?php echo $visitor->id(); ?>" />
<input type="file" name="image" />
</fieldset>
<fieldset>
<input type="text" name="title" value="<?php if (isset($news)) echo $news->title(); ?>" placeholder="titre de la news" />
<?php if (isset($errors) && in_array(News::CONTENU_INVALIDE, $errors)) { ?>
<fieldset><?php echo 'Le contenu est invalide.'; ?></fieldset>
<?php } ?>
<textarea name="content" placeholder="Text de la news">
<?php if (isset($news)) echo $news->content(); ?>
</textarea>
</fieldset>
<?php
if (isset($news) && !$news->isNew())
{
	?>
    <fieldset>
    <input type="hidden" name="newsid" value="<?php echo $news->id(); ?>" />
    <select name="status">
    <option>Action</option>
    <option value="0">Suprimer</option>
    <option value="1">Modifier</option>
    </select>
    </fieldset>
    <fieldset><input type="submit" name="edit" value="Modifier" /></fieldset>
	<?php
}
else
{
	?>
    <input type="hidden" name="status" value="1" />
    <fieldset>
    <input type="submit" name="new" value="Ajouter" />
    <input type="reset" value="reprendre" />
    </fieldset>
	<?php
}
?>
</form>