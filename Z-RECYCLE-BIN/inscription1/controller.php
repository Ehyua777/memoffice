<?php
//Vérification du droit d'accès
if ($id!=0) error(ERR_IS_CO);
//Vérification des données soumis par le formulaire
if (!empty($_POST))
{
	$pw1=$_POST['pw1'];
	$pw2=$_POST['pw2'];
	$email=$_POST['email'];
	$pseudo=$_POST['pseudo'];
	$signature=text_chars($_POST['signature']);
	//Vérification du pseudo
	$pseudoAlert=inscription1\check_pseudo($pseudo);
	//Vérification du mot de pass
	$pwAlert=inscription1\check_pasword($pw1, $pw2);
	//Vérification de l'adresse email
	$emailAlert=inscription1\check_email($email);
	//Vérification de l'avatar
	$avatorAlert=inscription1\check_avator();
	//Vérification de la longuer de la signature
	$sigatureAlert=inscription1\strlen_signature($signature);
}
//Insertion des données dans la BD si tout va bien
if (!empty($_POST) && $pseudoAlert['alert'] < 1 && $pwAlert['alert'] < 1 && $emailAlert['alert'] < 1 && $avatorAlert['alert'] < 1 && $sigatureAlert['alert'] < 1)
{
	$filename=(!empty($_FILES['avator']['size']))?move_avator($_FILES['avator']):'';
	$temps = time();
	$pw1 = sha1($_POST['pw1']);
	$pseudo=htmlspecialchars($_POST['pseudo']);
	$signature = htmlspecialchars($_POST['signature']);
	$email = $_POST['email'];
	inscription($pseudo, $pw1, $email, $signature, $filename, $temps);
}
//Affichage du formulaire
include('form.php');
?>