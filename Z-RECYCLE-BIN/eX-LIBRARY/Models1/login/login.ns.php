<?php
namespace login;
function login()
{
	if (!empty($_POST))
	{
		global $db;
		//Vérification du remplissage des info
		if (empty($_POST['email']) && empty($_POST['pw']))
		{
			return 'Vous devez remplir tous les champs!';
		}
		elseif (empty($_POST['email']))
		{
			$loginErr='Vous devez remplir le champ email';
			return $loginErr;
		}
		elseif (empty($_POST['pw']))
		{
			$pwErr='Vous devez remplir le champ mot de passe';
			return $pwErr;
		}
		else
		{
			$query=$db->prepare('
			SELECT member_id, member_pseudo, member_pw, member_email, member_level
			FROM mem_members
			WHERE member_email = :email
			');
			$query->bindValue(':email', $_POST['email'], \PDO::PARAM_STR);
			$query->execute();
			$data=$query->fetch();
			if ($data['member_pw']==sha1($_POST['pw']))
			{
				//Si le membre est banni
				if ($data['member_level']==0)
				{
					$actifMessage='Désolé, vous avez été banni, impossible de vous 
					connecter sur ce site';
					return $actifMessage;
				}
				else
				{
					//Sinon c'est ok, on se connecte
					$_SESSION['id'] = $data['member_id'];
					$_SESSION['pseudo'] = $data['member_pseudo'];
					$_SESSION['email'] = $data['member_email'];
					$_SESSION['level'] = $data['member_level'];
					if (isset($_POST['remember']))
					{
						$expire = time() + 365*24*3600;
						setcookie('pseudo', $_SESSION['pseudo'], $expire);
						setcookie('email', $_SESSION['email'], $expire);
						setcookie('pw', $_POST['pw'], $expire);
					}
					if (!\config\checkAccessRights(ADMIN))
					{
						$welcomeMessage='Bienvenue&nbsp;'.$data['member_pseudo'].', vous 
						êtes maintenant connecté à&nbsp;'.APPTITLE;
						header('location:'.ROOTPATH.'/?msg=2');
					}
					else
					{
						$adminWcMessage=$welcomeMessage.'<br>'.'Au fait 
						'.$data['member_pseudo'].', aimerais-tu faire un tour sur ton 
						<a href="'.ROOTPATH.'/untitled" target="_blank">paneau d\'admi</a>
						?';
						header('location:'.ROOTPATH.'/?msg=2');
					}
				}
			}
			else
			{
				$pwError='Votre mot de passe est incorrecte, ou peut être même votre login
				';
				return $pwError;
			}
		}
	}
}