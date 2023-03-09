<?php
if (isset($_GET['op']) && isset($_GET['ex']))
{
	$exclusivity=writingsFront1\selectedExclusivity($_GET['ex']);
	foreach($exclusivity as $cle => $ex)
	{
		$exclusivity[$cle]['title'] = stripslashes($ex['title']);
		$exclusivity[$cle]['bref'] = nl2br(stripslashes($ex['text']));
	}
	if (!empty($exclusivity))
	{
		include('poem-exclusivity.php');
	}
	else
	{
		echo 'Auccune exclusivité n\'est disponible';
	}
}
elseif (isset($_GET['op']) && !isset($_GET['ex']))
{
	$poems=writingsFront1\selectedLastPoems($_GET['op'], 0, 1);
	foreach($poems as $cle => $poem)
	{
		$poems[$cle]['title'] = stripslashes($poem['title']);
		$poems[$cle]['intro'] = nl2br(stripslashes($poem['intro']));
		$poems[$cle]['text'] = nl2br(stripslashes($poem['text']));
	}
	if (!empty($poems))
	{
		include('poem-selected.php');
	}
}
?>

<?php
if (isset($_GET['op']) && isset($_GET['ex']))
{
	$poems=writingsFront1\selectedExclusivityTexts($_GET['op'], $_GET['ex']);
	foreach($poems as $cle => $poem)
	{
		$poems[$cle]['title'] = stripslashes($poem['title']);
		$poems[$cle]['intro'] = nl2br(stripslashes($poem['intro']));
		$poems[$cle]['text'] = nl2br(stripslashes($poem['text']));
	}
	if (!empty($poems))
	{
		include('poem-selected.php');
	}
	else
	{
		echo 'Auccune exclusivité n\'est disponible';
	}
}
else
{
	echo '';
}
?>