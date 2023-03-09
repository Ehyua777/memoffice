<?php namespace LLibrary\Entities;
class About
{
	// PROPRIETES //
	protected $welcomeMessage,
	$welcomePhoto,
	$websiteGoal;
	// SETTERS //
	public function setWelcomeMessage($message)
	{
		$this->welcomeMessage = stripslashes(htmlspecialchars($message));
	}
	public function setWelcomePhoto($fileName)
	{
		$this->welcomePhoto = stripslashes(htmlspecialchars($fileName));
	}
	public function setWebsiteGoal($content)
	{
		$this->websiteGoal = stripslashes(htmlspecialchars($content));
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
	public function websiteGoal()   { return $this->websiteGoal;    }
	public function welcomePhoto()  { return $this->welcomePhoto;   }
	public function welcomeMessage(){ return $this->welcomeMessage; }
}