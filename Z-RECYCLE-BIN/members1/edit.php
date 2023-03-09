<?php 
if (empty($_POST['sent']))
{
	// Si la variable est vide, on peut considérer qu'on est sur la page de formulaire
	//On commence par s'assurer que le membre est connecté
	if ($id==0) erreur(ERR_IS_NOT_CO);
	//On prend les infos du membre
	$query=$db->prepare('
	SELECT membre_pseudo, membre_email, membre_siteweb, membre_signature, membre_msn,
	membre_localisation, membre_avatar
	FROM ei_membres
	WHERE membre_id=:id
	');
	$query->bindValue(':id',$id,PDO::PARAM_INT);
	$query->execute();
	$data=$query->fetch();
	echo '<h1>Modifier son profil</h1>';
	include ('g-i-form.php');
	$query->CloseCursor();
}
else //Sinon on est dans la page de traitement
{
	//On déclare les variables
	$mdp_erreur = NULL;
	$email_erreur1 = NULL;
	$email_erreur2 = NULL;
	$msn_erreur = NULL;
	$signature_erreur = NULL;
	$avatar_erreur = NULL;
	$avatar_erreur1 = NULL;
	$avatar_erreur2 = NULL;
	$avatar_erreur3 = NULL;
	//Encore et toujours notre belle variable $i :p
	$i = 0;
	$temps = time();
	$signature = $_POST['signature'];
	$email = $_POST['email'];
	$msn = $_POST['msn'];
	$website = $_POST['website'];
	$localisation = $_POST['localisation'];
	$pass = sha1($_POST['password']);
	$confirm = sha1($_POST['confirm']);
	//Vérification du mdp
	if ($pass != $confirm || empty($confirm) || empty($pass))
	{
		$mdp_erreur = "Votre mot de passe et votre confirmation diffèrent ou sont vides";
		$i++;
	}
	//Vérification de l'adresse email
	//Il faut que l'adresse email n'ait jamais été utilisée (sauf si elle n'a pas 
	//étémodifiée)
	//On commence donc par récupérer le mail
	$query=$db->prepare('
	SELECT membre_email
	FROM ei_membres
	WHERE membre_id =:id
	');
	$query->bindValue(':id',$id,PDO::PARAM_INT);
	$query->execute();
	$data=$query->fetch();
	if (strtolower($data['membre_email']) != strtolower($email))
	{
		//Il faut que l'adresse email n'ait jamais été utilisée
		$query=$db->prepare('
		SELECT COUNT(*) AS nbr
		FROM ei_membres
		WHERE membre_email =:mail
		');
		$query->bindValue(':mail',$email,PDO::PARAM_STR);
		$query->execute();
		$mail_free=($query->fetchColumn()==0)?1:0;
		$query->CloseCursor();
		if(!$mail_free)
		{
			$email_erreur1 = "Votre adresse email est déjà utilisé par un membre";
			$i++;
		}
		//On vérifie la forme maintenant
		if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email) || empty(
		$email))
		{
			$email_erreur2 = "Votre nouvelle adresse E-Mail n'a pas un format valide";
			$i++;
		}
	}
	//Vérification de l’adresse MSN
	if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $msn) && !empty($msn))
	{
		$msn_erreur = "Votre nouvelle adresse MSN n'a pas un format valide";
		$i++;
	}
	//Vérification de la signature
	if (strlen($signature) > 200)
	{
		$signature_erreur = "Votre nouvelle signature est trop longue";
		$i++;
	}
	//Vérification de l'avatar
	if (!empty($_FILES['avatar']['size']))
	{
		//On définit les variables :
		$maxsize = 30072; //Poid de l'image
		$maxwidth = 100; //Largeur de l'image
		$maxheight = 100; //Longueur de l'image
		//Liste des extensions valides
		$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png', 'bmp' );
		if ($_FILES['avatar']['error'] > 0)
		{
			$avatar_erreur = "Erreur lors du tranfsert de l'avatar : ";
		}
		if ($_FILES['avatar']['size'] > $maxsize)
		{
			$i++;
			$avatar_erreur1 = "Le fichier est trop gros :
			(<strong>".$_FILES['avatar']['size']." Octets</strong> contre <strong>".
			$maxsize." Octets</strong>)";
		}
		$image_sizes = getimagesize($_FILES['avatar']['tmp_name']);
		if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight)
		{
			$i++;
			$avatar_erreur2 = "Image trop large ou trop longue :
			(<strong>".$image_sizes[0]."x".$image_sizes[1]."</strong> contre<strong>".
			$maxwidth."x".$maxheight."</strong>)";
		}
		$extension_upload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.') ,1))
		;
		if (!in_array($extension_upload,$extensions_valides) )
		{
			$i++;
			$avatar_erreur3 = "Extension de l'avatar incorrecte";
		}
	}
}
echo '<h1>Modification d\'un profil</h1>';
if ($i == 0) // Si $i est vide, il n'y a pas d'erreur
{
	if (!empty($_FILES['avatar']['size']))
	{
		$nomavatar=move_avatar($_FILES['avatar']);
		$query=$db->prepare('
		UPDATE ei_membres
		SET membre_avatar = :avatar
		WHERE membre_id = :id
		');
		$query->bindValue(':avatar',$nomavatar,PDO::PARAM_STR);
		$query->bindValue(':id',$id,PDO::PARAM_INT);
		$query->execute();
		$query->CloseCursor();
	}
	//Une nouveauté ici : on peut choisis de supprimer l'avatar<br />
	if (isset($_POST['delete']))
	{
		$query=$db->prepare('
		UPDATE ei_membres
		SET membre_avatar=0
		WHERE membre_id = :id
		');
		$query->bindValue(':id',$id,PDO::PARAM_INT);
		$query->execute();
		$query->CloseCursor();
	}
	echo'<h1>Modification terminée</h1>';
	echo'<p>Votre profil a été modifié avec succès !</p>';
	echo'<p>Cliquez <a href="./index.php">ici</a>pour revenir à la page d accueil</p>';
	//On modifie la table
	$query=$db->prepare('
	UPDATE ei_membres
	SET membre_mdp = :mdp, membre_email=:mail, membre_msn=:msn, membre_siteweb=:website,
	membre_signature=:sign, membre_localisation=:loc
	WHERE membre_id=:id
	');
	$query->bindValue(':mdp',$pass,PDO::PARAM_INT);
	$query->bindValue(':mail',$email,PDO::PARAM_STR);
	$query->bindValue(':msn',$msn,PDO::PARAM_STR);
	$query->bindValue(':website',$website,PDO::PARAM_STR);
	$query->bindValue(':sign',$signature,PDO::PARAM_STR);
	$query->bindValue(':loc',$localisation,PDO::PARAM_STR);
	$query->bindValue(':id',$id,PDO::PARAM_INT);
	$query->execute();
	$query->CloseCursor();
}
else
{
	echo'<h1>Modification interrompue</h1>';
	echo'<p>Une ou plusieurs erreurs se sont produites pendant la modification du profil
	</p>';
	echo'<p>'.$i.' erreur(s)</p>';
	echo'<p>'.$mdp_erreur.'</p>';
	echo'<p>'.$email_erreur1.'</p>';
	echo'<p>'.$email_erreur2.'</p>';
	echo'<p>'.$msn_erreur.'</p>';
	echo'<p>'.$signature_erreur.'</p>';
	echo'<p>'.$avatar_erreur.'</p>';
	echo'<p>'.$avatar_erreur1.'</p>';
	echo'<p>'.$avatar_erreur2.'</p>';
	echo'<p>'.$avatar_erreur3.'</p>';
	echo'<p> Cliquez <a href="'.ROOTPATH.'/members?action=modifier">ici</a> pour
	recommencer</p>';
}
?>