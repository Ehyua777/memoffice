<?php
if (isset($_SESSION['pseudo']))
{
	?>
    <em>Salut&nbsp;<?php echo $pseudo; ?>&nbsp;!</em>
    <?php
}
else
{
	?>
	<em>L' Elégant Né</em>
    <?php
}
?>