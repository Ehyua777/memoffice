<form method="post" action="<?php $config->rp() ?>">
<fieldset>
<legend>Réintégration</legend>
<?php
foreach ($userManager->listByLevel() as $banished)
{
	?>
	<label>
    <a href="<?php $config->rp() ?>/members/?m=<?php echo $banished['id'];?>">
	<?php echo $banished['pseudo'] ?>
    </a>
    </label>
    <input type="checkbox" name="email" value="<?php echo $banished['email'] ?>" />
    <?php
}
?>
</fieldset>
<fieldset>
<input type="submit" name="reins" value="Réintégré" />
</fieldset>
</form>