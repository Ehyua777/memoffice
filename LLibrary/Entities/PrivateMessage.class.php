<?php
namespace LLibrary\Entities;
class PrivateMessage
{
	protected $errors = array(),
	$messageID,
	$talkNumber,
	$answerID,
	$senderID,
	$title,
	$content,
	$addressee,
	$previous,
	$postTime,
	$status,
	$senderPseudo,
	$signature,
	$avator,
	$localisation,
	$iDate,
	$posts;
	
	// LES CONSTANTES DE CLASS //
	const INVALID_TITLE     = 1;
	const INVALID_CONTENT   = 2;
	const INVALID_SENDER    = 3;
	const INVALID_ADDRESSEE = 3;
	const INVALID_EXTENSION = 4;
	const IMAGE_TOO_HEAVY   = 5;
	const IMAGE_MAX_SIZE    = 130340;
	const IMAGE_MAX_WIDTH   = 405;
	const IMAGE_MAX_HEIGHT  = 405;
	const LOARDING_ERROR    = 6;
	
	// FONCTONS DE VERIFICATION //
	public function isNew()
	{
		return (empty($this->messageID) || empty($this->answerID));
	}
	public function isValid()
	{
		return !(empty($this->sender) || empty($this->title) || empty($this->content));
	}
	
	// SETTERS //
	public function setMessageID($id)
	{
		$this->messageID = (int) $id;
	}
	public function setTalkNumber($number)
	{
		if ($number==0)
		{
			$number = 1;
			$this->talkNumber = (int) $number;
		}
		else
		{
			$this->talkNumber = (int) $number;
		}
	}
	public function setAnswerID($id)
	{
		$this->answerID = (int) $id;
	}
	public function setSenderID($auteur)
	{
		if (!empty($auteur))
		{
			$this->senderID = (int) $auteur;
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
			$this->errors[] = self::INVALID_TITLE;
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
			$this->errors[] = self::INVALID_CONTENT;
		}
		else
		{
			$this->content = stripslashes(htmlspecialchars($contenu));
		}
	}
	public function setAddressee($receveur)
	{
		if (!empty($receveur))
		{
			if (is_string($receveur))
			{
				$this->addressee=stripslashes(htmlspecialchars($receveur));
			}
			elseif (is_int($receveur))
			{
				$this->addressee = (int) $receveur;
			}
			else
			{
				$this->errors[] = self::INVALID_ADDRESSEE;
			}
		}
		else
		{
			$this->errors[] = self::INVALID_ADDRESSEE;
		}
	}
	public function setPrevious($id)
	{
		$this->previous = (int) $id;
	}
	public function setPostTime($dateAjout)
	{
		if (is_string($dateAjout) && preg_match('`[0-9]{2}/[0-9]{2}/[0-9]{4} à 
		[0-9]{2}h[0-9]{2}`', $dateAjout))
		{
			$this->postTime = $dateAjout;
		}
	}
	public function setStatus($status)
	{
		$this->status = (int) $status;
	}
	public function setSenderPseudo($auteurPseudo)
	{
		$this->senderPseudo = stripslashes(htmlspecialchars($auteurPseudo));
	}
	public function setSignature($signature)
    {
		if (!empty($signature) && strlen($signature) <= 200)
		{
			$this->signature = stripslashes(htmlspecialchars($signature));
		}
    }
	public function setAvator($fileName)
    {
		$this->avator = $fileName;
	}
	public function setLocalisation($loc)
    {
		$this->localisation = stripslashes(htmlspecialchars($loc));
	}
	public function setIDate($idate)
	{
		$this->iDate = $idate;
	}
	public function setPosts($post)
    {
		$this->posts = $post;
	}
	// HYDRATATION DE L'OBJET //
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
	// CONSTRUCTEUR DE L'OBJET //
	public function __construct($values = array())
	{
		if (!empty($values))
		{
			$this->hydrate($values);
		}
	}
	// GETTERS //
	public function errors(){ return $this->errors; }
	public function messageID(){ return $this->messageID; }
	public function talkNumber(){ return $this->talkNumber; }
	public function answerID(){ return $this->answerID; }
	public function senderID(){ return $this->senderID; }
	public function title(){ return $this->title; }
	public function content(){ return $this->content; }
	public function addressee(){ return $this->addressee; }
	public function previous(){ return $this->previous; }
	public function postTime(){ return $this->postTime; }
	public function status(){ return $this->status; }
	public function senderPseudo(){ return $this->senderPseudo; }
	public function signature(){ return $this->signature; }
	public function avator(){ return $this->avator; }
	public function localisation(){ return $this->localisation; }
	public function iDate(){ return $this->iDate; }
	public function posts(){ return $this->posts; }
	// AUTRES FONCTIONS //
}