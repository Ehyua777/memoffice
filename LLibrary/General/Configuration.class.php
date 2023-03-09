<?php
namespace LLibrary\General;
class Configuration
{
	protected $vars = array(), 
	$rp,
	$avatorDir,
	$photoDir;
	
	// SETTERS //	
	public function setRp()
	{
		$this->rp = 'http://'.$_SERVER['HTTP_HOST'];
	}
	public function setAvatorDir()
	{
		$this->avatorDir = $this->getConfigData('avator_dir');
	}
	public function setPhotoDir()
	{
		$this->photoDir = $this->getConfigData('photo_dir');
	}
	
	// CONSTRUCTEUR //
	public function __construct()
	{
		$this->setRp();
		$this->setAvatorDir();
	}
	
	// GETTERS //
	public function rp()       { return $this->rp;        }
	public function avatorDir(){ return $this->avatorDir; }
	public function photoDir() { return $this->photoDir;  }
	
	// AUTRES FONCTIONS //
	public function getConfigData($var)
	{
		if (!$this->vars)
		{
			$xml = new \DOMDocument;
			$xml->load(__DIR__.'/../../Config/data.xml');
			$elements = $xml->getElementsByTagName('define');
			foreach ($elements as $element)
			{
				$this->vars[$element->getAttribute('var')] 
				=
				$element->getAttribute('value');
			}
		}
		if (isset($this->vars[$var])){ return $this->vars[$var]; }
		return null;
	}
}