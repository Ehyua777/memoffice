<?php
namespace LLibrary\Entities;
class Admin extends Owner
{
	protected $errors=array(),
	$adminEmail,
	$colour,
	$smID,
	$memberID,
	$rollCode,
	$heading,
	$speciality,
	$promoter,
	$memberPseudo;
	// CONSTANTES DE CLASS //
	const INVALID_ADMIN = 1;
	// SETTERS //
	public function setColour()
	{
		// ...
	}
	public function setSmID($smid)
	{
		$this->smID = (int) $smid;
	}
	public function setMemberID($memberID)
	{
		$this->memberID = (int) $memberID;
	}
	public function setRollCode($code)
	{
		$this->rollCode = $code;
	}
	public function setHeading($h)
	{
		$this->heading = stripslashes(htmlspecialchars($h));
	}
	public function setSpeciality($s)
	{
		$this->speciality = stripslashes(htmlspecialchars($s));
	}
	public function setPromoter($p)
	{
		if (is_int($p))
		{
			$this->promoter = (int) $p;
		}
		elseif (is_string($p))
		{
			$this->promoter = stripslashes(htmlspecialchars($p));
		}
		else
		{
			$this->errors[] = self::INVALID_ADMIN;
		}
	}
	public function setMemberPseudo($pseudo)
	{
		$this->memberPseudo = stripslashes(htmlspecialchars($pseudo));
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
	public function colour(){ /* ... */ }
	public function smID(){ return $this->smID; }
	public function memberID(){ return $this->memberID; }
	public function rollCode(){ return $this->rollCode; }
	public function heading(){ return $this->heading; }
	public function speciality(){ return $this->speciality; }
	public function promoter(){ return $this->promoter; }
	public function memberPseudo(){ return $this->memberPseudo; }
	
	// AUTRES FONCTIONS //
	public function addModerator(Member $member)
	{
		$member->setRights(self::MODO);
	}
}