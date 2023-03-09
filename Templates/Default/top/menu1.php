<nav>
<ul>
<?php
foreach($layout->topMenu() as $item)
{
	?>
    <li>
    <a href="<?php echo $config->rp().'/'.$item->link(); ?>" accesskey="<?php echo $item->accessKey() 
	?>" title="<?php echo $item->description() ?>">
	<?php echo $item->name(); ?>
    </a>
    </li>
    <?php
}
?>
</ul>
</nav>