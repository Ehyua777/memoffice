<?php
namespace img;

//Rengement d'image dans le local
function moveImage($image)
{
	$extensionUpload=strtolower(substr(strrchr($image['name'], '.') ,1));
	$name = time();
	$imagename = str_replace(' ','',$name).'.'.$extensionUpload;
	$name = '../web/images/local/'.str_replace('','',$name).'.'.$extensionUpload;
	move_uploaded_file($image['tmp_name'],$name);
	return $imagename;
}

//Smileys
function smileys($texte)
{
	$texte = str_replace(':D ', '<img src="/web/images/smilies/cool.png" 
	title="heureux" alt="heureux" />', $texte);
	$texte = str_replace(':lol: ', '<img src="/web/images/smilies/cool.png" 
	title="lol" alt="lol" />', $texte);
	$texte = str_replace(':triste:', '<img src="/web/images/smilies/cool.png"
	title="triste" alt="triste" />', $texte);
	$texte = str_replace(':frime:','<img src="/web/images/smilies/cool.png" title="cool" alt="cool" />', $texte);
	$texte = str_replace(':rire:', '<img src="/web/images/smilies/cool.png" 
	title="rire" alt="rire" />', $texte);
	$texte = str_replace(':s', '<img src="/web/images/smilies/cool.png" 
	title="confus" alt="confus" />', $texte);
	$texte = str_replace(':O', '<img src="/web/images/smilies/cool.png" 
	title="choc" alt="choc" />', $texte);
	$texte = str_replace(':question:', '<img src="/web/images/smilies/cool.png" title="?" 
	alt="?" />', $texte);
	$texte = str_replace(':exclamation:', '<img src="/web/images/smilies/cool.png" 
	title="!" alt="!" />', $texte);
	//On retourne la variable texte
	return $texte;
}

//Gestion de l'image à afficher
function icon()
{
	if (!empty($id)) // Si le membre est connecté
{
	if ($data['tv_id'] == $id) //S'il a lu le topic
	{
		if ($data['tv_poste'] == '0') // S'il n'a pas posté
		{
			if ($data['tv_post_id'] == $data['topic_last_post'])
			//S'il n'y a pas de nouveau message
			{
				$ico_mess = 'message.png';
			}
			else
			{
				$ico_mess = 'messagec_non_lus.gif'; //S'il y a un nouveau message
			}
		}
		else // S'il a posté
		{
			if ($data['tv_post_id'] == $data['topic_last_post'])
			//S'il n'y a pas de nouveau message
			{
				$ico_mess = 'messagep_lu.gif';
			}
			else //S'il y a un nouveau message
			{
				$ico_mess = 'messagep_non_lu.gif';
			}
		}
	}
	else //S'il n'a pas lu le topic
	{
		$ico_mess = 'message_non_lu.gif';
	}
}
//S'il n'est pas connecté
else
{
	$ico_mess = 'message.gif';
}
return $ico_mess;
}