<div class="comments">
<div class="comment-avator"><?php echo $comment->displayAvator() ?></div>
<div class="meta">
<p class="byline">
Posté le <?php echo $comment->postDate() ?> par <?php echo $comment->pseudo() ?>
<?php
if ($visitor->id()==$comment->author())
{
	?>
    <a href="#">Edit</a>
	<?php
}
elseif ($visitor->isModerator() || $visitor->id()==$comment->author())
{
	echo '<a href="#">Edit</a> | <a href="#">Suprimer</a>';
}
?>
</p>
</div>
<div class="entry">
<p>
<?php echo $content->content() ?>
</p>
</div>
</div>