<?php
foreach($layout->sideMenu() as $item)
{

	?>
    <li>
    <a href="<?php echo $config->rp().'/'.$item->link() ?>" 
    title="<?php echo $item->description() ?>"><?php echo $item->name() ?></a>
    </li>
    <?php
}
?>