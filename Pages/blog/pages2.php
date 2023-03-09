<div class="pagging">
<ul>
<?php
if ($runningPage2 > 1 || $runningPage2 == $pagesNumber2)
{
	?>
    <li>
    <a href="p-<?php echo ($runningPage2-1) ?>">Previous</a>
    </li>
	<?php
}
for ($i=1; $i <= $pagesNumber2; $i++)
{
	if ($runningPage2 == $i)
	{
		?>
        <li><a href=""><?php echo $i ?></a></li>
		<?php
    }
	else
	{
		?>
        <li>
        <a href="p-<?php echo $i ?>"><?php echo $i ?></a>
        </li>
		<?php
     }
}
if ($runningPage2 < $pagesNumber2)
{
	?>
    <li>
    <a href="/blog/subject/<?php echo $subject->url().'-'.$subject->id() ?>/p-<?php echo ($runningPage2+1) ?>">
    Next
    </a>
    <?php
}
?>
</li>
</ul>
</div>