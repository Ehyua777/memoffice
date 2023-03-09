<?php
namespace LLibrary\Entities;
class News
{
	protected $errors = array(),
	$id,
	$author,
	$title,
	$content,
	$image,
	$postDate,
	$editDate,
	$status;
	/*** Constantes relatives aux erreurs possibles rencontrées lors de
	l'exécution de la méthode.
	*/
	const AUTEUR_INVALIDE   = 1;
	const TITRE_INVALIDE    = 2;
	const CONTENU_INVALIDE  = 3;
	const INVALID_EXTENSION = 4;
	const IMAGE_TOO_HEAVY   = 5;
	const IMAGE_MAX_SIZE    = 130340;
	const IMAGE_MAX_WIDTH   = 405;
	const IMAGE_MAX_HEIGHT  = 405;
	const LOARDING_ERROR    = 6;
	
	public function isNew()
	{
		return empty($this->id);
	}
	public function isValid()
	{
		return !(empty($this->author) || empty($this->title) || empty($this->content));
	}
	// SETTERS //
	public function setId($id)
	{
		$this->id = (int) $id;
	}
	public function setAuthor($auteur)
	{
		if (!empty($auteur))
		{
			if (is_string($auteur))
			{
				$this->author=stripslashes(htmlspecialchars($auteur));
			}
			elseif (is_int($auteur))
			{
				$this->author = (int) $auteur;
			}
			else
			{
				$this->errors[] = self::AUTEUR_INVALIDE;
			}
		}
		else
		{
			$this->errors[] = self::INVALID_SENDER;
		}
	}
	public function setTitle($titre)
	{
		if (!is_string($titre) || empty($titre))
		{
			$this->errors[] = self::TITRE_INVALIDE;
		}
		else
		{
			$this->title = stripslashes(htmlspecialchars($titre));
		}
	}
	public function setContent($contenu)
	{
		if (!is_string($contenu) || empty($contenu))
		{
			$this->errors[] = self::CONTENU_INVALIDE;
		}
		else
		{
			$this->content = nl2br(stripslashes(htmlspecialchars($contenu)));
		}
	}
	public function setImage($fileName)
    {
		if (!empty($fileName))
		{
			$this->image = $fileName;
		}
		else
		{
			$this->image = '';
		}
	}
	public function setPostDate($dateAjout)
	{
		if (is_string($dateAjout) && preg_match('` [0-9]{2}/[0-9]{2}/[0-9]{4} à 
		[0-9]{2}h[0-9]{2}`', $dateAjout))
		{
			$this->postDate = $dateAjout;
		}
	}
	public function setEditDate($dateModif)
	{
		if (is_string($dateModif) && preg_match('` [0-9]{2}/[0-9]{2}/[0-9]{4} à 
		[0-9]{2}h[0-9]{2}`', $dateModif))
		{
			$this->editDate = $dateModif;
		}
	}
	public function setStatus($status)
	{
		$this->status = (int) $status;
	}
	public function hydrate($data)
	{
		foreach ($data as $attribute => $value)
		{
			$method = 'set'.ucfirst($attribute);
			if (is_callable(array($this, $method)))
			{
				$this->$method($value);
			}
		}
	}
	public function __construct($values = array())
	{
		 // Si on a spécifié des valeurs, alors on hydrate l'objet.
		if (!empty($values))
		{
			$this->hydrate($values);
		}
	}
	// GETTERS //
	public function errors(){ return $this->errors; }
	public function id(){ return $this->id; }
	public function author(){ return $this->author; }
	public function title(){ return $this->title; }
	public function content(){ return $this->content; }
	public function image(){ return $this->image; }
	public function postDate(){ return $this->postDate; }
	public function editDate(){ return $this->editDate; }
	public function status(){ return $this->status; }
	// AUTRES FONCTIONS //
	public function checkImage($image=array())
	{
		if ($image['error'] > 0 && empty($image['size']))
		{
			return self::LOARDING_ERROR;
		}
		elseif ($image['size'] > self::IMAGE_MAX_SIZE)
		{
			return self::IMAGE_TOO_HEAVY;
		}
		else
		{
			$fileSizes=getimagesize($image['tmp_name']);
			if ($fileSizes[0] > self::IMAGE_MAX_WIDTH || $fileSizes[1] > self::
			IMAGE_MAX_HEIGHT)
			{
				$imageErr='Image trop large ou trop longue :(<strong>'.$imageSizes[0].
				'x'.$imageSizes[1].'</strong> contre <strong>'.$maxwidth.'x'.$maxheight.'
				</strong>)';
				return $imageErr;
			}
			else
			{
				$validExtensions=array('jpg', 'jpeg', 'gif', 'png', 'bmp');
				$extensionUpload=strtolower(substr(strrchr($image['name'],'.') 
				,1));
				if (!in_array($extensionUpload, $validExtensions))
				{
					return self::INVALID_EXTENSION;
				}
			}
		}
	}
	public function moveImage(array $image, $directory)
	{
		$directory =__DIR__.'/../../'.$directory.'/';
		$extensionUpload=strtolower(substr(strrchr($image['name'], '.') ,1));
		$name = time();
		$imagename = str_replace(' ','',$name).'.'.$extensionUpload;
		$name=$directory.str_replace('', '', $name).'.'.$extensionUpload;
		move_uploaded_file($avator['tmp_name'], $name);
		$this->setImage($imagename);
	}
}