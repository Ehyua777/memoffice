<?php
namespace txt;
//Mise en forme du texte
function textStyle($texte)
{
	//gras
	$texte = preg_replace('`\[g\](.+)\[/g\]`isU', '<strong>$1</strong>', $texte);
	//italique
	$texte = preg_replace('`\[i\](.+)\[/i\]`isU', '<em>$1</em>', $texte);
	//souligné
	$texte = preg_replace('`\[s\](.+)\[/s\]`isU', '<u>$1</u>', $texte);
	//lien
	$texte = preg_replace('#http://[a-z0-9._/-]+#i', '<a href="$0">$0</a>', $texte);
	//La quote
	$texte = preg_replace('`\[quote\](.+)\[/quote\]`isU', '<div id="quote">$1</div>',
	$texte);
	//On retourne la variable texte
	return $texte;
}

//Définition des carractères spéciaux
function textChars($texte)
{
	//Â
	$texte = preg_replace('#[Â]#', '&Acirc;', $texte);
	//â
	$texte = preg_replace('#[â]#', '&acirc;', $texte);
	//à
	$texte = preg_replace('#[à]#', '&agrave;', $texte);
	//É
	$texte = preg_replace('#[É]#', '&Eacute;', $texte);
	//é
	$texte = preg_replace('#[é]#', '&eacute;', $texte);
	//ê
	$texte = preg_replace('#[ê]#', '&ecirc;', $texte);
	//È
	$texte = preg_replace('#[È]#', '&Egrave;', $texte);
	//è
	$texte = preg_replace('#[è]#', '&egrave;', $texte);
	//Ç
	$texte = preg_replace('#[Ç]#', '&Ccedil;', $texte);
	//ç
	$texte = preg_replace('#[ç]#', '&ccedil;', $texte);
	//Ô
	$texte = preg_replace('#[Ô]#', '&Ocirc;', $texte);
	//ô
	$texte = preg_replace('#[ô]#', '&ocirc;', $texte);
	//Œ
	$texte = preg_replace('#[Œ]#', '&OElig;', $texte);
	//œ
	$texte = preg_replace('#[œ]#', '&oelig;', $texte);
	//Û
	$texte = preg_replace('#[Û]#', '&Ucirc;', $texte);
	//û
	$texte = preg_replace('#[û]#', '&ucirc;', $texte);
	//Ü
	$texte = preg_replace('#[Ü]#', '&Uuml;', $texte);
	//ü
	$texte = preg_replace('#[ü]#', '&uuml;', $texte);
	//Ú
	$texte = preg_replace('#[Ú]#', '&Uacute;', $texte);
	//ú
	$texte = preg_replace('#[ú]#', '&uacute;', $texte);
	//Ù
	$texte = preg_replace('#[Ù]#', '&Ugrave;', $texte);
	//ù
	$texte = preg_replace('#[ù]#', '&ugrave;', $texte);
	//©
	$texte = preg_replace('#[©]#', '&copy;', $texte);
	//®
	$texte = preg_replace('#[®]#', '&reg;', $texte);
	//€
	$texte = preg_replace('#[€]#', '&euro;', $texte);
	//"
	$texte = preg_replace('#["]#', '&quot;', $texte);
	//<
	$texte = preg_replace('#[<]#', '&lt;', $texte);
	//>
	$texte = preg_replace('#[>]#', '&gt;', $texte);
	//On retourne la variable texte
	return $texte;
}