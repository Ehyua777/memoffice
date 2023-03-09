<?php
//Selection de la dernièrre exclusivité
/*$exclusivities=writingsFront1\exclusivity(0, 1);
foreach($exclusivities as $cle => $subject)
{
	$exclusivities[$cle]['title'] = stripslashes(htmlspecialchars($subject['title']));
	if (strlen($subject['text']) >= 200)
	{
		$subject['text'] = substr($exclusivities[$cle]['text'], 0, 200);
		$subject['text'] = substr($subject['text'], 0, strrpos($subject['text'], ' ')) . 
		'...';
	}
	else
	{
		
		$exclusivities[$cle]['text']=nl2br(stripslashes(htmlspecialchars($subject['text'
		])));
	}

}
if (!empty($exclusivities))
{
	include('exclusivity.php');
}
*/
?>