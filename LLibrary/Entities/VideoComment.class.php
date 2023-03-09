<?php namespace LLibrary\Entities;
class VideoComment
{
	protected $errors = array(),
	$id,
	$videoID,
	$author,
	$pseudo,
	$content,
	$avator,
	$postDate,
	$editDate,
	$validity;
	
	const INVALID_CONTENT = 1;
	const INVALID_AUTHOR  = 2;
	const INVALID_TEXT    = 3;
	
	public function __construct($values = array())
	{
		if (!empty($values))
		{
			$this->hydrate($values);
		}
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
	/**
	* Méthode permettant de savoir si la news est nouvelle.
	* @return bool
	*/
	public function isNew()
	{
		return empty($this->id);
	}
	/**
	* Méthode permettant de savoir si la news est valide.
	* @return bool
	*/
	public function isValid()
	{
		return !(empty($this->author) || empty($this->bsId) || empty($this->content) || 
		$this->validity==0);
	}
	// SETTERS //
	public function setId($id)
	{
		$this->id = (int) $id;
	}
	public function setVideoID($id)
	{
		$this->videoID = (int) $id;
	}
	public function setContent($contenu)
	{
		if (!is_string($contenu) || empty($contenu))
		{
			$this->errors[] = self::INVALID_CONTENT;
		}
		else
		{
			$this->content = stripslashes(htmlspecialchars($contenu));
		}
	}
	public function setAuthor($auteur)
	{
		if (!empty($auteur))
		{
			if (is_string($auteur))
			{
				$this->author=$auteur;
			}
			elseif (is_int($auteur))
			{
				$this->author = (int) $auteur;
			}
			else
			{
				$this->errors[] = self::INVALID_AUTHOR;
			}
		}
		else
		{
			$this->errors[] = self::INVALID_AUTHOR;
		}
	}
	public function setAvator($fileName)
    {
		$this->avator = $fileName;
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
	public function setValidity($status)
	{
		$this->validity = (int) $status;
	}
	public function setPseudo($pseudo)
    {
		if (!empty($pseudo) && is_string($pseudo))
        {
			$this->pseudo = stripslashes(htmlspecialchars($pseudo));
		}
    }
	// GETTERS //
	public function errors()  { return $this->errors;   }
	public function id()      { return $this->id;       }
	public function videoID() { return $this->videoID;  }
	public function content() { return $this->content;  }
	public function author()  { return $this->author;   }
	public function avator()  { return $this->avator;   } 
	public function postDate(){ return $this->postDate; }
	public function editDate(){ return $this->editDate; }
	public function validity(){ return $this->validity; }
	public function pseudo()  { return $this->pseudo;   }
	// OTHERS FUNCTIONS //
	public function generateAvator($id='avator')
	{
		$avator = '<img src="/Web/loads/img/avators/'.$this->avator.'" id="'.$id.'" 
		title="'.$this->pseudo.'" />';
		return $avator;
	}
	public function displayAvator()
	{
		$avator = $this->generateAvator();
		echo $avator;
	}
}