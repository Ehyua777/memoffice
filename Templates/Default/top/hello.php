<?php
if ($visitor->isFounder())
{
	?>
    <span id="hello">The boss&nbsp;<?php echo $visitor->pseudo() ?>&nbsp;!</span>
    <?php
}
elseif ($visitor->isAuthenticated())
{
	?>
    <span id="hello">Salut&nbsp;<?php echo $visitor->pseudo() ?>&nbsp;!</span>
    <?php
}
else
{
	?>
	<span id="hello">L'&nbsp;&Eacute;légant Né</span>
    <?php
}
?>