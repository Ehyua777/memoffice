<?php namespace LLibrary\Entities;
class BlogSubject
{
	protected $errors = array(),
	$id,
	$title,
	$text,
	$url,
	$image,
	$sender,
	$postDate,
	$editDate,
	$status,
	$pseudo,
	$alias;
	
	const INVALID_TITLE     = 1;
	const INVALID_TEXT      = 2;
	const INVALID_SENDER    = 3;
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
		return !(empty($this->sender) || empty($this->title) || empty($this->text) || 
		$this->status==0);
	}
	// SETTERS //
	public function setId($id)
	{
		$this->id = (int) $id;
	}
	public function setTitle($titre)
	{
		if (!is_string($titre) || empty($titre))
		{
			$this->errors[] = self::INVALID_TITLE;
		}
		else
		{
			$this->title = stripslashes(htmlspecialchars($titre));
		}
	}
	public function setText($contenu)
	{
		if (!is_string($contenu) || empty($contenu))
		{
			$this->errors[] = self::INVALID_TEXT;
		}
		else
		{
			$this->text = stripslashes(htmlspecialchars($contenu));
		}
	}
	public function setUrl($url)
	{
		$this->url = $url;
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
	public function setSender($auteur)
	{
		if (!empty($auteur))
		{
			if (is_string($auteur))
			{
				$this->sender=stripslashes(htmlspecialchars($auteur));
			}
			elseif (is_int($auteur))
			{
				$this->sender = (int) $auteur;
			}
			else
			{
				$this->errors[] = self::INVALID_SENDER;
			}
		}
		else
		{
			$this->errors[] = self::INVALID_SENDER;
		}
	}
	public function setPostDate($dateAjout)
	{
		if (is_string($dateAjout) && preg_match('`le [0-9]{2}/[0-9]{2}/[0-9]{4} à 
		[0-9]{2}h[0-9]{2}`', $dateAjout))
		{
			$this->postDate = $dateAjout;
		}
	}
	public function setEditDate($dateModif)
	{
		if (is_string($dateModif) && preg_match('`le [0-9]{2}/[0-9]{2}/[0-9]{4} à 
		[0-9]{2}h[0-9]{2}`', $dateModif))
		{
			$this->editDate = $dateModif;
		}
	}
	public function setStatus($status)
	{
		$this->status = (int) $status;
	}
	public function setPseudo($pseudo)
	{
		$this->pseudo=stripslashes(htmlspecialchars($pseudo));
	}
	public function setAlias($alias)
	{
		$this->alias = $alias;
	}
	//Hydratation de l'objet
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
	//Constructeur d'un objet de cette classe
	public function __construct($values = array())
	{
		if (!empty($values))
		{
			$this->hydrate($values);
		}
	}
	// GETTERS //
	public function errors()  { return $this->errors; }
	public function id()      { return $this->id; }
	public function title()   { return $this->title; }
	public function text()    { return $this->text; }
	public function url()     { return $this->url; }
	public function image()   { return $this->image; }
	public function sender()  { return $this->sender; }
	public function pseudo()  { return $this->pseudo; }
	public function postDate(){ return $this->postDate; }
	public function editDate(){ return $this->editDate; }
	public function alias()   { return $this->alias; }
	public function status()  { return $this->status; }
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
	//Rengement d'image dans le local
	public function moveImage($image)
	{
		$extensionUpload=strtolower(substr(strrchr($image['name'], '.') ,1));
		$name = time();
		$imagename = str_replace(' ','',$name).'.'.$extensionUpload;
		$name = '../uploads/images/doc/'.str_replace('','',$name).'.'.$extensionUpload;
		move_uploaded_file($image['tmp_name'],$name);
		$this->image=$imagename;
	}
	public function generateImage()
	{
		if (!empty($this->image))
		{
			$img = '<img src="/Web/loads/img/blog/'.$this->image.'" />';
		}
		else
		{
			$img = '';
		}
		return $img;
	}
	public function displayImage()
	{
		$image = $this->generateImage();
		echo $image;
	}
}