<div class="comments">
<img src="<?php ROOTPATH ?>/uploads/images/avators/<?php echo $comment->avator() ?>" width="70" height="70" />
<div class="entry">
<p>
<?php echo $content->content() ?>
</p>
</div>
<div class="meta">
<p class="byline">
Posté le <?php echo $comment->postDate() ?> par <?php echo $comment->author() ?>
<?php
if ($id==$comment->author())
{
	echo ' | <a href="#">Edit</a>';
}
elseif (config\checkAccessRights(MODO) || $id==$comment->author())
{
	echo ' | <a href="#">Edit</a>';
	echo ' | <a href="#">Suprimer</a>';
}
?>
</p>
</div>
</div>