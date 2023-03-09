<div class="pagging">
<ul>
<?php
if ($runningPage > 1 || $runningPage==$pagesNumber)
{
	?>
    <li><a href="<?php ROOTPATH; ?>?p=<?php echo ($runningPage-1) ?>">Previous</a></li>
	<?php
}
for ($i=1; $i <= $pagesNumber; $i++)
{
	if ($runningPage==$i)
	{
		?>
        <li><a href=""><?php echo $i ?></a></li>
		<?php
    }
	else
	{
		?>
        <li>
        <a href="<?php ROOTPATH; ?>?p=<?php echo $i ?>"><?php echo $i ?></a>
        </li>
		<?php
     }
}
if ($runningPage < $pagesNumber)
{
	?>
    <li>
    <a href="<?php ROOTPATH; ?>?p=<?php echo ($runningPage+1) ?>">Next</a>
    <?php
}
?>
</li>
</ul>
</div>
<br clear="all" />
<br clear="all">