<?php namespace LLibrary\Entities;
session_start();
abstract class User implements \LLibrary\Interfaces\IUser
{
	// ATTRIBUTS DE LA CLASS //
	protected $id,
	$pseudo,
	$test1,
	$test2,
	$pw,
	$email,
	$signature,
	$rights,
	$avator,
	$iDate,
	$lVDate,
	$fName,
	$name,
	$genre,
	$birthDay,
	$birthMonth,
	$birthYear,
	$bio,
	$localisation,
	$website,
	$firstIp,
	$alias,
	$posts;
		
	public function checkUser()
	{
		//Si le pseudo n'est pas vide
		return !empty($this->id);
	}
	// SETTERS //
	public function setId($id)
	{
		$this->id = (int) $id;
	}
	public function setPseudo($newPseudo)
	{
		if (!empty($newPseudo) && is_string($newPseudo))
		{
			if (strlen($newPseudo) > 5 && strlen($newPseudo) < 15)
			{
				$this->pseudo = stripslashes(htmlspecialchars($newPseudo));
			}
		}
	}
	// Vérification du mot de passe
	public function checkPasword1($pw1, $pw2)
	{
		//Vérification du mdp
		if (!empty($pw1) && !empty($pw2))
		{
			if ($pw1 == $pw2)
			{
				$pw1=sha1($pw2);
				$this->setPw($pw1);
			}
		}
	}
	//Mot de passe de confirmation
	public function setTest1($test1)
	{
		$this->test1 = $test1;
	}
	public function setTest2($test2)
	{
		$this->test2 = $test2;
	}
	public function setPw($pw)
	{
		$this->pw = $pw;
	}
	public function setEmail($email)
	{
		if (!empty($email))
		{
			//Vérification du format de l'email
			if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email))
			{
				$this->email = $email;
			}
		}
	}
	public function setSignature($signature)
	{
		if (!empty($signature) && strlen($signature) <= 200)
		{
			$this->signature = stripslashes(htmlspecialchars($signature));
		}
	}
	public function setFName($fname)
	{
		// Vérifier si le nouveau pseudo n'est ni vide ni trop long
		if (!empty($fname) && is_string($fname))
		{
			$this->fName = stripslashes(htmlspecialchars($fname));
		}
	}
	public function setName($name)
	{
		// Vérifier si le nouveau pseudo n'est ni vide ni trop long
		if (!empty($name) && is_string($name))
		{
			$this->name = stripslashes(htmlspecialchars($name));
		}
	}
	public function setGenre($sex)
	{
		$this->genre = $sex;
	}
	public function setBirthDay($day)
	{
		$this->birthDay=$day;
	}
	public function setBirthMonth($month)
	{
		$this->birthMonth=$month;
	}
	public function setBirthYear($year)
	{
		$this->birthYear=$year;
	}
	public function setWebsite($wsite)
	{
		$this->website = $wsite;
	}
	public function setAvator($fileName)
	{
		$this->avator = $fileName;
	}
	public function setLocalisation($loc)
	{
		$this->localisation = stripslashes(htmlspecialchars($loc));
	}
	public function setBio($biogr)
	{
		$this->bio = stripslashes(htmlspecialchars($biogr));
	}
	public function setPosts($post)
	{
		$this->posts = $post;
	}
	public function setIDate($idate)
	{
		$this->iDate = $idate;
	}
	public function setLVDate($lvdate)
	{
		$this->lVDate = $lvdate;
	}
	public function setFirstIp($ip)
	{
		$this->firstIp = (int) $ip;
	}
	public function setAlias($alias)
	{
		if (empty($alias))
		{
			$alias = $this->pseudo;
		}
		$alias = str_replace("'", "_", $alias);
		$alias = str_replace(" ", "_", $alias);
		$alias = strtolower($alias);
		$this->alias = stripslashes(htmlspecialchars($alias));
	}
	public function setRights($level)
	{
		$this->rights = $level;
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
	public function id()          { return $this->id;           }
	public function pseudo()      { return $this->pseudo;       }
	public function pw()          { return $this->pw;           }
	public function email()       { return $this->email;        }
	public function signature()   { return $this->signature;    }
	public function rights()      { return $this->rights;       }
	public function avator()      { return $this->avator;       }
	public function iDate()       { return $this->iDate;        }
	public function lVDate()      { return $this->lVDate;       }
	public function fName()       { return $this->fName;        }
	public function name()        { return $this->name;         }
	public function genre()       { return $this->genre;        }
	public function birthDay()    { return $this->birthDay;     }
	public function birthMonth()  { return $this->birthMonth;   }
	public function birthYear()   { return $this->birthYear;    }
	public function website()     { return $this->website;      }
	public function localisation(){ return $this->localisation; }
	public function bio()         { return $this->bio;          }
	public function posts()       { return $this->posts;        }
	public function alias()       { return $this->alias;        }
	public function firstIp()     { return $this->firstIp;      }
	
	// AUTRES FONCTIONS //
	public function setCookies($pw)
	{
		$expire = time() + (365*24*3600);
		setcookie('pseudo', $_SESSION['pseudo'], $expire);
		setcookie('email' , $_SESSION['email'] , $expire);
		setcookie('pw'    , $pw                , $expire);
	}
	public static function destructCookies()
	{
		setcookie('pseudo', '', -1);
		setcookie('email' , '', -1);
		setcookie('pw'    , '', -1);
	}
	public function setSessions(User $member)
	{
		$_SESSION['id']     = $member->id();
		$_SESSION['pseudo'] = $member->pseudo();
		$_SESSION['rights'] = $member->rights();
		$_SESSION['email']  = $member->email();
	}
	public function updateSessionAttribute($index, $value)
	{
		$_SESSION[$index] = $value;
	}
	public static function refreshSession()
	{
		if (isset($_COOKIE['pseudo']) && empty($_SESSION['id']))
		{
			// Il n'y a une connection
			$_SESSION['pseudo'] = $_COOKIE['pseudo'];
			$_SESSION['email']  = $_COOKIE['email'];
		}
	}
	public static function checkAccessRights($accessRignt)
	{
		$rights=(isset($_SESSION['rights']))?$_SESSION['rights']:1;
		return ($accessRignt <= intval($rights));
	}
	public function getSessionAttribute($attr)
	{
		return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
	}
	public function __destruct(){}
}