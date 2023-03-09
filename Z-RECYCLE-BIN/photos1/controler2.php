<h1 class="title">Poster une photo</h1>
<br clear="all" />
<?php
//Vérification du droit d'accès
if (!check_access_rights(MODO)) header('location:'.ROOTPATH.'/error');
//Vérification des données soumis par le formulaire
if (!empty($_POST['id']) && $_POST['id']=='photo')
{
	extract($_POST);
	$photoAlert=photoBack1\check_photo();
}
//Insertion des données dans la BD si tout va bien
if (!empty($_POST['id']) && $_POST['id']=='photo' && $photoAlert['alert'] == 0)
{
	$photoName=(!empty($_FILES['photo']['size']))?photoBack1\upload_photos($_FILES['photo'
	]):'';
	$title=htmlspecialchars($_POST['title']);
	$comment=htmlspecialchars($_POST['comment']);
	photoBack1\photo_poster($title, $photoName, $comment);
}
include('photos-form.php');
?>