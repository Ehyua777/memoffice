<h2>Les last-posted</h2>
<ul>
<?php
$lastTitles = $subjectManager->getList(0, 6);
if (!empty($lastTitles))
{
	foreach($lastTitles as $title)
	{
		if (strlen($title->text()) <= 100)
		{
			$content = $title->text();
		}
		else
		{
			$text = substr($title->text(), 0, 50);
			$text = substr($text, 0, strrpos($text, ' ')) . '...';
			$content = nl2br($text);
		}
		?>
        <li>
        <a href="<?php $config->rp() ?>/blog/?bp=comm&amp;s=<?php echo $title->id(); 
		?>" title="<?php echo $content ?>&nbsp;<?php echo $title->postDate() ?>">
		<?php echo $title->title() ?>
        </a>
        </li>
		<?php
	}
}
else
{
	?>
	<li><a href="#">Consectetuer adipiscing elit</a></li>
	<li><a href="#">metus aliquam pellentesque</a></li>
	<li><a href="#">Suspendisse iaculis mauris</a></li>
	<li><a href="#">Urnanet non molestie semper</a></li>
	<li><a href="#">Proin gravida orci porttitor</a></li>
    <?php
}
?>
</ul>