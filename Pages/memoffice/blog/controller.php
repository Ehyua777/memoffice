<?php
$action = 'manage-blog-subjects';
if (!isset($_GET['alias']))
{
	header('location:'.$config->rp().'/Error');
}
elseif ($_GET['alias'] != $member->alias())
{
	header('location:'.$config->rp().'/Error');
}
elseif (!isset($_GET['ap']))
{
	header('location:'.$config->rp().'/Error');
}
/*elseif (isset($_GET['ap']) && $_GET['ap'] != $action)
{
	header('location:'.$config->rp().'/Error');
}*/
?>
<?php if ($visitor->isModerator()) { ?>
<?php
$addMsg='Le sujet a bien été ajoutée !';
$editMsg='Le sujet a bien été modifiée !';
if (isset($_GET['edit']))
{
	$subject = $subjectManager->getUnique((int) $_GET['edit']);
}
else
{
	$subject = new LLibrary\Entities\BlogSubject();
}
?>
<?php
if (isset($_POST['sender']))
{
	if (isset($subject))
	{
		if (isset($_FILES['image']) && !empty($_FILES['image']['name']))
		{
			$alert = $subject->checkImage($_FILES['image']);
		}
		if (isset($alert) && !empty($alert))
		{
			if (!is_int($alert))
			{
				$message=$alert;
			}
			else
			{
				switch ($alert)
				{
					case LLibrary\Entities\BlogSubject::LOARDING_ERROR :
					$message ='Désolé, une erreur est survenu lors du chargement';
					break;
					case LLibrary\Entities\BlogSubject::IMAGE_TOO_HEAVY :
					$message ='Wowo, l\'image est trop lourde!';
					break;
					case LLibrary\Entities\BlogSubject::INVALID_EXTENSION :
					$message = 'Extension invalide';
					break;
				}
			}
		}
		else
		{
			if (isset($_FILES['image']) && !empty($_FILES['image']['name']))
			{
				$subject->moveImage($_FILES['image']);
				$subject = new LLibrary\Entities\BlogSubject(array(
				'title'  => $_POST['title'],
				'text'   => $_POST['content'],
				'image'  => $subject->image(),
				'sender' => $id,
				'status' => $_POST['status']
				));
			}
			else
			{
				$subject = new LLibrary\Entities\BlogSubject(array(
				'title' => $_POST['title'],
				'text' => $_POST['content'],
				'image' => $subject->image(),
				'sender' => $id,
				'status' => $_POST['status']
				));
			}
			if (isset($_POST['newsubject']))
			{
				$subjectManager->add($subject);
				$message = $subject->isNew() ? $addMsg : $editMsg;
			}
			else
			{
				$subject->setId($_POST['subjectid']);
				$subjectManager->update($subject);
				$message = $subject->isNew() ? $addMsg : $editMsg;
			}
		}
	}
}
?>
<h1 class="title">Interface de gestion du blog</h1>
<meta charset="utf-8" />
<div id="post">
<?php include('form.php'); ?>
</div>
<p>
Il y a actuellement <?php echo $subjectManager->count(); ?> Sujet poster sur le doc.
En voici la liste :
</p>
<table width="100%">
<tr>
   <th>Auteur</th>
   <th>Titre</th>
   <th>Date d'ajout</th>
   <th>Dernière modification</th>
   <th>Action</th>
</tr>
<?php
foreach ($subjectManager->getList() as $subject)
{
	?>
	<tr>
       <td><?php echo $subject->sender() ?></td>
       <td><?php echo $subject->title() ?></td>
       <td><?php echo $subject->postDate() ?></td>
       <td>
	   <?php 
	   echo ($subject->postDate()==$subject->editDate() ? '-' : $subject->editDate())
	   ?>
       </td>
       <td>
       <a href="<?php echo $action ?>/<?php echo $subject->url() ?>-<?php echo $subject->id() ?>">
       Modifier ou suprimer
       </a>
       </td>
    </tr>
    <?php
}
?>
</table>
<?php } else { ?>
<?php header('location:'.$config->rp().'/Error'); ?>
<?php } ?>