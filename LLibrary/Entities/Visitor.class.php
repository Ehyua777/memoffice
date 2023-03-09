<?php 
namespace LLibrary\Entities;
class Visitor extends User
{
	protected $errors = array(),
	$id,
	$ip,
	$page,
	$connectionTime,
	$visitorsNumber,
	$membersNumber,
	$noMembersNumber,
	$pseudo;
	
	// GETTERS //
	public function setId($id)
	{
		$this->id = (int) $id;
	}
	public function setIp($ip)
	{
		if (!empty($ip))
		{
			$this->ip = (int) $ip;
		}
	}
	public function setPage($p)
	{
		if (is_int($p))
		{
			$this->page = (int) $p;
		}
		else
		{
			$this->page = stripslashes(htmlspecialchars($p));
		}
	}
	public function setConnectionTime($time)
	{
		$this->connectionTime = $time;
	}
	public function setVisitorsNumber($vn)
	{
		$this->visitorsNumber = (int) $vn;
	}
	public function setMembersNumber($mn)
	{
		$this->membersNumber = (int) $mn;
	}
	public function setNoMembersNumber($nomn)
	{
		$this->noMembersNumber = (int) $nomn;
	}
	public function setPseudo($pseudo)
    {
		if (!empty($pseudo) && is_string($pseudo))
        {
			$this->pseudo = stripslashes(htmlspecialchars($pseudo));
		}
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
	public function ip(){ return $this->ip; }
	public function page(){ return $this->page; }
	public function connectionTime(){ return $this->connectionTime; }
	public function pseudo(){ return $this->pseudo; }
	public function visitorsNumber(){ return $this->visitorsNumber; }
	public function membersNumber(){ return $this->membersNumber; }
	public function noMembersNumber(){ return $this->noMembersNumber; }
	
	// OTHERS FUNCTIONS //
	public function isAuthenticated()
	{
		return isset($_SESSION['id']) && $_SESSION['id'] != 0;
	}
	private function isMember()
	{
		if ($this->isAuthenticated() && $_SESSION['rights'] > self::VISITOR) return true;
		else return false;
	}
	public function isModerator()
	{
		if ($this->isMember() && $_SESSION['rights'] > self::MEMBER) return true;
		else return false;
	}
	public function isFounder()
	{
		if ($this->isModerator() && $_SESSION['rights']==self::OWNER) return true;
		else return false;
	}
	public function isWebMaster()
	{
		if ($this->isModerator() && $_SESSION['rights'] > self::OWNER) return true;
		else return false;
	}
	public function isAllRightsOne()
	{
		if ($this->isWebMaster() && $_SESSION['rights']==self::ALL_RIGHTS) return true;
		else return false;
	}
	public function generateAvator($dir='Web/loads/img/avators', $id='avator')
	{
		if ($this->isAuthenticated())
		{
			$avator = '<img src="/'.$dir.'/'.$this->avator.'" id="'.$id.'" 
			title="'.$this->pseudo.'" />';
		}
		else
		{
			$avator = '<img src="/'.$dir.'/default_avator.png" id="'.$id.'" />';
		}
		return $avator;
	}
	public function displayAvator()
	{
		$avator = $this->generateAvator();
		echo $avator;
	}
}