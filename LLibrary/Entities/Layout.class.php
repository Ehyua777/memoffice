<?php
namespace LLibrary\Entities;
class Layout
{
	protected $appTitle,
	$websiteDescription, 
	$signature,
	$lSignature;
	
	public function setAppTitle($wsName)
    {
		$this->appTitle = $wsName;
    }
	public function setWebsiteDescription($wsDescription)
    {
		$this->websiteDescription = $wsDescription;
    }
	public function setSignature($wsSignature)
    {
		$this->signature = $wsSignature;
    }
	public function setLSignature($lSignature)
    {
		$this->lSignature = $lSignature;
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
		if (!empty($values))
		{
			$this->hydrate($values);
		}
	}
	
	public function appTitle(){ return $this->appTitle; }
	public function websiteDescription(){ return $this->websiteDescription; }
	public function signature(){ return $this->signature; }
	public function lSignature(){ return $this->lSignature; }
}