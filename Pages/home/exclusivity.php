<meta charset="utf-8" />
<div class="post">
<h2 class="title"><?php echo $subject['title']; ?></h2>
<p>
<?php
if (!empty($subject['image']))
{
	?>
	<img src="<?php ROOTPATH; ?>/web/images/local/<?php echo $subject['image'] ?>" 
    class="left" width="100" height="100" />
    <?php
}
else
{
	echo '';
}
?>
</p>
<div class="entry">
<p><?php echo $subject['text']; ?></p>
</div>
<p class="byline"><small>Posté le <?php echo $subject['date']; ?>
<?php if (config\checkAccessRights(MODO)) echo '| <a href="#">Edit</a>'; ?></small>
</p>
<p class="meta">
<a href="<?php ROOTPATH; ?>/writings/?op=<?php echo $subject['type']?>&amp;ex=<?php echo $subject['exclusivity_id']; ?>" class="more">Lire la suite</a>&nbsp;&nbsp;&nbsp;<a href="<?php ROOTPATH; ?>/writings/?op=<?php echo $subject['type']?>&amp;ex=<?php echo $subject['exclusivity_id']; ?>">Commentaires</a>
</p>
</div>
<br clear="all" />