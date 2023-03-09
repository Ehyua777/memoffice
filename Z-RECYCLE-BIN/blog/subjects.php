<h2><a href="subject/<?php echo $subject->url() ?>-<?php echo $subject->id() ?>">
<?php echo $subject->title()?></a></h2>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
if ($subject->image()=='')
{
	?>
    <tr>
       <td align="left"><?php echo $content->content() ?></td>
    </tr>
    <?php
}
else
{
	?>
    <tr>
        <td>
        <img src="/Web/loads/img/blog/<?php echo $subject->image() ?>" width="70" 
        height="70" />
        </td>
          <td align="left">
		   <?php echo $content->content(); ?>
         </td>
        </tr>
		<?php
}
?>
</table>