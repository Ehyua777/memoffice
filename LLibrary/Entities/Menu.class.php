<?php 
namespace LLibrary\Entities;
class Menu
{
	protected $errors = array(),
	$accessKey,
	$link,
	$name,
	$description,
	$level;
	
	// SETTERS //
	public function setAccessKey($accesskey)
	{
		$this->accessKey = (int) $accesskey;
	}
	public function setLink($link)
	{
		$this->link = $link;
	}
	public function setName($name)
	{
		$this->name = $name;
	}
	public function setDescription($description)
	{
		$this->description = stripslashes(htmlspecialchars($description));
	}
	public function setLevel($level)
	{
		$this->level = $level;
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
	public function accessKey(){ return $this->accessKey; }
	public function link(){ return $this->link; }
	public function name(){ return $this->name; }
	public function description(){ return $this->description; }
	public function level(){ return $this->level; }
}