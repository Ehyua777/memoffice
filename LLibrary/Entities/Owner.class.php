<?php namespace LLibrary\Entities;
class Owner extends Modo
{
	protected $hisPseudo,
	$hisEmal;
	
	public function setHisPseudo($pseudo)
	{
		$this->hisPseudo = stripslashes(htmlspecialchars($pseudo));
	}
	
	public function _construct($pseudo)
	{
		$this->setHisPseudo($pseudo);
	}
	
	public function hisPseudo(){ return $this->hisPseudo; }
}