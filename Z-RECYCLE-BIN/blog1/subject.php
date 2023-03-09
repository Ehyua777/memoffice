<div class="post">
<h1 class="title"><?php echo $subject->title() ?></h1>
<div class="entry">
<p>
<?php
if ($subject->image()!='')
{
	?>
  <img src="<?php ROOTPATH ?>/uploads/images/doc/<?php echo $subject->image() ?>" 
    class="left" />
  <?php echo $content->content() ?>
  <?php
}
else
{
	echo $content->content();
}
?>
</p>
</div>
<br clear="all" /><br clear="all" />
<div class="meta">
<p class="byline">
Par <?php echo $subject->sender() ?> le <?php echo $subject->postDate() ?>
</p>
<?php 
if ($subject->postDate() != $subject->editDate())
{
	?>
    <p class="byline">
    <small>&nbsp;&nbsp;Modifiée le <?php echo $subject->editDate() ?> par 
	<?php echo $subject->sender() ?></small>
    </p>
    <?php
}
?>
<?php
if ($id==$subject->sender())
{
	echo ' | <a href="#">Edit</a>';
}
elseif (LLibrary\Entities\User::checkAccessRights(LLibrary\Entities\User::MODO) || 
$id==$subject->sender())
{
	echo ' | <a href="#">Edit</a>';
	echo ' | <a href="#">Suprimer</a>';
}
?>
</div>
</div>