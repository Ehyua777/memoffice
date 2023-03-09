<div class="post">
<h2><a href="./subject/<?php echo $subject->url() ?>-<?php echo $subject->id() ?>"><?php echo $subject->title()?></a></h2>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
//$controller = new self;
if ($subject->image()=='')
{
	?>
    <tr>
       <td align="left"><?php echo $content->content(); ?></td>
    </tr>
    <?php
}
else
{
	?>
    <tr>
        <td>
        <img src="<?php ROOTPATH ?>/uploads/images/doc/<?php echo $subject->image() ?>" width="70" height="70" />
         </td>
          <td align="left">
		   <?php echo $content->content(); ?>
         </td>
        </tr>
		<?php
}
?>
</table>
</div>
<br clear="all" />