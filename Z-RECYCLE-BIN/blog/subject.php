<section>
<h2 class="title"><?php echo $subject->title(); ?></h2>
<p class="byline"><small>Posté le <?php echo $subject->postDate() ?> par
<a href="<?php $config->rp() ?>/members/<?php echo $subject->sender().'/'.$subject->alias() ?>">
<?php echo $subject->pseudo() ?></a> 
<?php if ($visitor->id()==$subject->sender()) echo '| <a href="#">Edit</a>'; ?></small>
</p>
<p class="byline"><small>Modifiée le <?php echo $subject->editDate() ?> par 
<?php echo $subject->pseudo() ?></small>
</p>
<article>
<p><?php $subject->displayImage() ?></p>
<p><?php echo $content->content() ?></p>
<p class="meta">
<?php
if ($visitor->id()==$subject->sender())
{
	echo '<a href="#">Edit</a>';
}
elseif ($visitor->isModerator() || $visitor->id()==$subject->sender())
{
	?>
	<a href="#">Edit</a><a href="#">Suprimer</a>
    <?php
}
?>
</p>
</article>
</section>