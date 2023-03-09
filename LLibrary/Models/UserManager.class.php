<?php
namespace LLibrary\Models;
//session_start();
class UserManager extends DBFactory implements \LLibrary\Interfaces\IUser
{
	const BAD_PW = 1;
	//Récupère toute les information sur un membre
	public function setAUser($userID)
	{
		// Récupérer en base de données les infos du membre
		$sql='
		SELECT user_id id, user_pseudo pseudo, user_pw pw, user_email email, 
		user_signature signature, user_avator avator, user_iDate iDate, 
		user_lVDate lVDate, user_firstName fName, user_name name, user_genre 
		genre, user_birthDay birthDay, user_birthMonth birthMonth, user_birthYear 
		birthYear, user_website website, user_localisation localisation, user_shortBio 
		bio, user_posts posts, user_alias alias, user_rights rights, user_firstIp firstIp
		FROM l_users
		WHERE user_id = :user
		';
		$query=$this->db->prepare($sql);
		$query->bindValue(':user', (int) $userID, \PDO::PARAM_INT);
		$query->execute() or die(print_r($db->errorInfo()));
		$user = $query->fetch(\PDO::FETCH_ASSOC);
		switch ($user['rights'])
		{
			case self::BANISHED   : 
			return new \LLibrary\Entities\Member($user);
			case self::MEMBER     : 
			return new \LLibrary\Entities\Member($user);
			case self::MODO       : 
			return new \LLibrary\Entities\Modo($user);
			case self::OWNER      : 
			return new \LLibrary\Entities\Owner($user);
			case self::ADMIN      : 
			return new \LLibrary\Entities\Admin($user);
			case self::ALL_RIGHTS : 
			return new \LLibrary\Entities\AllRights($user);
			default: return null;
		}
	}
	// Inscription d'un membre
	public function add(\LLibrary\Entities\Member $member)
	{
		$sql='
		INSERT INTO l_users (user_pseudo, user_pw, user_email, user_signature, 
		user_lVDate, user_alias, user_rights, user_firstIp)
		VALUES (:pseudo, :pw, :email, :signature, NOW(), :alias, :rights, :firstIp)
		';
		$query=$this->db->prepare($sql);
		$query->bindValue(':pseudo'   , $member->pseudo());
		$query->bindValue(':pw'       , $member->pw());
		$query->bindValue(':email'    , $member->email());
		$query->bindValue(':signature', $member->signature());
		$query->bindValue(':alias'    , $member->alias());
		$query->bindValue(':firstIp'  , $member->firstIp());
		$query->bindValue(':rights'   , self::MEMBER, \PDO::PARAM_INT);
		$query->execute() or die(print_r($db->errorInfo()));
		$member->hydrate(array('id' => $this->db->lastInsertId()));
		//Assignation de l'id du visiteur à l'objet
		$member->setId($this->db->lastInsertId());
		//Et on définit les variables de sessions
		$member->setSessions($member);
		if (!empty($_SESSION['pseudo'])) return true;
	}
	//Fonction de connection
	public function login(\LLibrary\Entities\Visitor $visitor, $rememberMe)
	{
		$sql='
		SELECT user_id id
		FROM l_users
		WHERE user_email = :email
		';
		$query=$this->db->prepare($sql);
		$query->bindValue(':email', $visitor->email());
		$query->execute() or die(print_r($db->errorInfo()));
		$data = $query->fetch();
		$userManager = new self($this->db);
		$member = $userManager->setAUser($data['id']);
		if ($member->pw() == sha1($visitor->pw()))
		{
			if ($member->rights()!= self::BANISHED)
			{
				//Actualisation des sessions
				$member->setSessions($member);
				//Actualisation des cookies si la demande est ok
				if ($rememberMe == 'ok')
				{
					$member->setCookies($visitor->pw());
				}
				if (isset($_SESSION['pseudo'])) return true;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return self::BAD_PW;
		}
	}
	//Fonction de déconnection
	public function logout($userID)
	{
		if ($userID!=0)
		{
			if (isset($_COOKIE['pseudo']))
			{
				\LLibrary\Entities\User::destructCookies();
			}
			session_destroy();
			$sql='
			DELETE FROM l_whosonline
			WHERE online_id=:id
			';
			$query=$this->db->prepare($sql);
			$query->bindValue(':id', $userID, \PDO::PARAM_INT);
			$query->execute() or die(print_r($db->errorInfo()));
			//$user->__destruct();
			return self::ACTION_SUCCESS;
		}
		else
		{
			return self::ACTION_FAILURE;
		}
	}
	public function checkExistence($data)
	{
		// On veut voir si tel personnage ayant pour id $info existe.
		if (is_int($data))
		{
			$sql1='
			SELECT COUNT(*)
			FROM l_users
			WHERE user_id = '.$data;
			return (bool) $this->db->query($sql1)->fetchColumn();
		}
		else
		{
			if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $data))
			{
				$sql2='
				SELECT COUNT(*)
				FROM l_users
				WHERE user_email = :email
				';
				$query = $this->db->prepare($sql2);
				$query->execute(array(':email' => $data));
			}
			else
			{
				// Sinon, c'est qu'on veut vérifier que le nom existe ou pas.
				$sql3='
				SELECT COUNT(*)
				FROM l_users
				WHERE user_pseudo = :pseudo
				';
				$query = $this->db->prepare($sql3);
				$query->execute(array(':pseudo' => $data));
			}
			return (bool) $query->fetchColumn();
		}
	}
	public function update(\LLibrary\Entities\Member $member)
	{
		$sql='
		UPDATE l_users
		SET user_firstName=:fName, user_name=:name, 
		user_genre=:genre, user_birthDay=:day, user_birthMonth=:month, 
		user_birthYear=:year, user_shortBio=:bio, user_localisation=:loc, 
		user_website=:site
		WHERE user_id = :id
		';
		$query=$this->db->prepare($sql);
		$query->bindValue(':fName', $member->fName());
		$query->bindValue(':name', $member->name());
		$query->bindValue(':genre', $member->genre());
		$query->bindValue(':day', $member->birthDay());
		$query->bindValue(':month', $member->birthMonth());
		$query->bindValue(':year', $member->birthYear());
		$query->bindValue(':bio', $member->bio());
		$query->bindValue(':loc', $member->localisation());
		$query->bindValue(':site', $member->website());
		$query->bindValue(':id', $member->id());
		$query->execute() or die(print_r($db->errorInfo()));
	}
	//Modifier le pseudo
	public function editPseudo(\LLibrary\Entities\Member $member)
	{
		$sql='
		UPDATE l_users
		SET user_pseudo = :pseudo, user_alias = :alias
		WHERE user_id = :id
		';
		$query=$this->db->prepare($sql);
		$query->bindValue(':pseudo', $member->pseudo());
		$query->bindValue(':alias' , $member->alias());
		$query->bindValue(':id'    , $member->id());
		$query->execute() or die(print_r($db->errorInfo()));
		//Actualisation des sessions
		$member->updateSessionAttribute('pseudo', $member->pseudo());
	}
	//Modifier le mot de passe
	public function editPw(\LLibrary\Entities\Member $member)
	{
		$sql='
		UPDATE l_users
		SET user_pw =:pw
		WHERE user_id = :id
		';
		$query=$this->db->prepare($sql);
		$query->bindValue(':pw', $member->pw());
		$query->bindValue(':id', $member->id());
		$query->execute() or die(print_r($db->errorInfo()));
	}
	//modifier l'email
	public function editEmail(\LLibrary\Entities\Member $member)
	{
		$sql='
		UPDATE l_users
		SET user_email = :email
		WHERE user_id = :id
		';
		$query=$this->db->prepare($sql);
		$query->bindValue(':email', $member->email());
		$query->bindValue(':id', $member->id());
		$query->execute() or die(print_r($db->errorInfo()));
		//Actualisation des session
		$member->updateSessionAttribute('email', $member->email());
		return true;
	}
	// Modification de l'avatar
	public function updateAvator(\LLibrary\Entities\Member $member)
	{
		$sql='
		UPDATE l_users
		SET user_avator = :avator
		WHERE user_id = :id
		';
		$query=$this->db->prepare($sql);
		$query->bindValue(':avator', $member->avator());
		$query->bindValue(':id', $member->id());
		$query->execute() or die(print_r($db->errorInfo()));
	}
	//Modifier la signature du membre
	public function editSignature(\LLibrary\Entities\Member $member)
	{
		$sql='
		UPDATE l_users
		SET user_signature = :signature
		WHERE user_id = :id
		';
		$query=$this->db->prepare($sql);
		$query->bindValue(':signature', $member->signature());
		$query->bindValue(':id', $member->id());
		$query->execute() or die(print_r($db->errorInfo()));
	}
	public function count()
	{
		$sql='SELECT COUNT(*) FROM l_users WHERE user_rights <> 0';
		return $this->db->query($sql)->fetchColumn();
	}
	public function countByLevel($level=0)
	{
		$sql='SELECT COUNT(*) FROM l_users WHERE user_rights = '.$level;
		return $this->db->query($sql)->fetchColumn();
	}
	//Listing des membres bani
	public function listByLevel($level=0)
	{
		$sql='
		SELECT user_id id, user_pseudo pseudo, user_email email
		FROM l_users 
		WHERE user_rights = ?
		';
		$query = $this->db->prepare($sql);
		$query->execute(array($level)) or die(print_r($db->errorInfo()));
		return $query->fetchAll();
	}
	public function getList($debut = -1, $limite = -1)
	{
		$sql='
		SELECT user_id id, user_pseudo pseudo, user_pw pw, user_email email, 
		user_signature signature, user_avator avator, user_iDate iDate, 
		user_lVDate lVDate, user_firstName fName, user_name name, user_genre 
		genre, user_birthDay birthDay, user_birthMonth birthMonth, user_birthYear 
		birthYear, user_website website, user_localisation localisation, user_shortBio 
		bio, user_posts posts, user_alias alias, user_rights rights, user_firstIp firstIp
		FROM l_users
		ORDER BY user_id DESC
		';
		//On vérifie l'intégrité des paramètres fournis.
		if ($debut != -1 || $limite != -1)
		{
			$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
		}
		$query=$this->db->prepare($sql);
		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 
		'\LLibrary\Entities\User');
		$usersList = $query->fetchAll();
		return $usersList;
	}
}