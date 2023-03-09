<?php namespace LLibrary\Entities;
class Photo
{
	const PHOTO_MAX_WIDTH  = 500;
	const PHOTO_MAX_HEIGHT = 500;
	const PHOTO_MAX_SIZE   = 60000;
	
	static $extentionError = 'Extension de la photo incorrecte';
	static $loadingError   = 'Erreur lors du transfert de la photo';
	static $emptyFile      = 'Fichier vide';
	
	protected $id,
	$title,
	$fileName,
	$comment,
	$postDate,
	$validity;
	
	// VERIFICATIONS DES ATRIBUTS //
	public function checkFifleName()
	{
		return !empty($this->fileName);
	}
	public function checkTitle()
	{
		return !empty($this->title);
	}
	
	// SETTERS //
	public function setId($id)
	{
		$this->id = (int) $id;
	}
    public function setTitle($title)
    {
		// Vérifier si le nouveau pseudo n'est ni vide ni trop long
		if (!empty($title) && is_string($title))
        {
			$this->title = stripslashes(htmlspecialchars($title));
		}
    }
    public function setFileName($file_name)
    {
		$this->fileName = $file_name;
	}
	public function setComment($comment)
    {
		if (!empty($comment) && strlen($comment) <= 200)
		{
			$this->comment = stripslashes(htmlspecialchars($comment));
		}
    }
	public function setPostDate($post_date)
	{
		$this->postDate = $post_date;
	}
	public function setValidity($valid)
	{
		$this->validity = (int) $valid;
	}
	
	// HYDRATATION //
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
	
	// CONSTRUCTEUR //
	public function __construct($values = array())
	{
		if (!empty($values))
		{
			$this->hydrate($values);
		}
	}
	
	// GETTERS //
	public function id(){ return $this->id; }
	public function title(){ return $this->title; }
	public function fileName(){ return $this->fileName; }
	public function comment(){ return $this->comment; }
	public function postDate(){ return $this->postDate; }
	public function validity(){ return $this->validity; }
	
	// AUTRES FONCTIONS
	public function checkPhoto(array $photo)
	{
		$alert=0;
		$photoErr=NULL;
		$photoAlert=array();
		//Vérification de la photo
		if (!empty($photo['size']))
		{
			$photoSizes=getimagesize($photo['tmp_name']);
			$validExtensions=array('jpg', 'jpeg', 'gif', 'png', 'bmp');
			$extensionUpload=strtolower(substr(strrchr($photo['name'], '.'), 1));
			//Liste des extensions valides
			if ($photo['error'] > 0)
			{
				$alert++;
				$photoErr = self::$loadingError;
			}
			if ($photo['size'] > self::PHOTO_MAX_SIZE)
			{
				$alert++;
				$photoErr='Le fichier est trop gros : 
				(<strong>'.$photo['size'].'Octets</strong> contre <strong>
				'.self::PHOTO_MAX_SIZE.' Octets</strong>)';
			}
			if ($photoSizes[0] > self::PHOTO_MAX_WIDTH || 
			$photoSizes[1] > self::PHOTO_MAX_HEIGHT)
			{
				$alert++;
				$photoErr='Image trop large ou trop longue :(<strong>'.$photoSizes[0].'x
				'.$photoSizes[1].'</strong> contre <strong>
				'.self::PHOTO_MAX_WIDTH.'x'.self::PHOTO_MAX_HEIGHT.'</strong>)';
			}
			if (!in_array($extensionUpload, $validExtensions))
			{
				$alert++;
				$photoErr = self::$extentionError;
			}
		}
		else
		{
			$alert++;
			$photoErr = self::$emptyFile;
		}
		$photoAlert=array(
		'alert' => $alert, 
		'error' => $photoErr
		);
		return $photoAlert;
	}
	//Chargement de l'avatar
	public function movePhoto(array $photo, $directory)
	{
		$directory =__DIR__.'/../../'.$directory.'/';
		$extensionUpload=strtolower(substr(strrchr($photo['name'], '.'), 1));
		$name = time();
		$fileName = str_replace(' ', '', $name).'.'.$extensionUpload;
		$name=$directory.str_replace('', '', $name).'.'.$extensionUpload;
		move_uploaded_file($photo['tmp_name'], $name);
		$this->setFileName($fileName);
	}
	// Générer une photo
	public function generatePhoto($dir='Web/loads/img/photos', $id='imgage-with-frame')
	{
		$photo = '<img src="/'.$dir.'/'.$this->fileName().'" alt="Portfolio 
		'.$this->id.'" title="'.$this->title.'" id="'.$id.'"/>';
		return $photo;
	}
	public function displayPhoto()
	{
		$photo = $this->generatePhoto();
		echo $photo;
	}
}