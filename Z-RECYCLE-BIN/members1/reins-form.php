<form method="post" action="<?php ROOTPATH; ?>">
<fieldset>
<legend>Réintégration</legend>
<?php
foreach($banishMembers as $member)
{
	?>
	<label>
    <a href="<?php ROOTPATH; ?>/members/?m=<?php echo $member['../../members/member_id'];?>">
	<?php echo $member['pseudo'] ?>
    </a>
    </label>
    <input type="checkbox" name="bMemberId" value="<?php echo $member['member_id'] ?>" />
    <br />
	<?php
}
?>
</fieldset>
<fieldset>
<input type="submit" value="Réintégré" />
</fieldset>
</form>