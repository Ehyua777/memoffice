<?php if ($visitor->isModerator()) { ?>
<h1 class="title">Administration des news</h1>
<br clear="all" />
<?php $newsManager = new LLibrary\Models\NewsManager_PDO($db); ?>
<?php
$addMsg='La news a bien été ajoutée !';
$editMsg='La news a bien été modifiée !';
if (isset($_GET['edit']))
{
	$news = $newsManager->getUnique((int) $_GET['edit']);
}
if (isset($_GET['delete']))
{
	$newsManager->delete((int) $_GET['delete']);
	$message = 'La news a bien été supprimée !';
}
else
{
	$news = new LLibrary\Entities\News();
}
?>
<?php
if (isset($_POST['author']))
{
	if (isset($news))
	{
		if (isset($_FILES['image']) && !empty($_FILES['image']['name']))
		{
			$alert = $news->checkImage($_FILES['image']);
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
				$news->moveImage($_FILES['image']);
			}
			$news = new LLibrary\Entities\News(array(
			'author' => $_POST['author'],
			'title' => $_POST['title'],
			'content' => $_POST['content'],
			'image' => $news->image(),
			'status' => $_POST['status']
			));
			if (isset($_POST['new']))
			{
				$newsManager->add($news);
				$message = $news->isNew() ? $addMsg : $editMsg;
			}
			else
			{
				$news->setId($_POST['newsid']);
				$newsManager->update($news);
				$message = $news->isNew() ? $addMsg : $editMsg;
			}
		}
	}
}
?>
<?php include('form.php'); ?>
<p>Il y a actuellement <?php echo $newsManager->count(); ?> news. En voici la liste :</p>
<table>
<tr>
   <th>Auteur</th>
   <th>Titre</th>
   <th>Date d'ajout</th>
   <th>Dernière modification</th>
   <th>Action</th>
</tr>
<?php
foreach ($newsManager->getList() as $news)
{
	?>
	<tr>
       <td><?php echo $news->author() ?></td>
       <td><?php echo $news->title() ?></td>
       <td><?php echo $news->postDate() ?></td>
       <td>
	   <?php echo ($news->postDate()==$news->editDate() ? '-' : $news->editDate()) ?>
       </td>
       <td>
       <a href="<?php $config->rp() ?>/news/?np=mana&amp;edit=<?php echo $news->id() ?>">
       Modifier
       </a> | 
       <a href="<?php $config->rp() ?>/news/?np=mana&amp;delete=<?php echo $news->id() ?>">
       Supprimer</a>
       </td>
    </tr>
    <?php
}
?>
</table>
<?php } ?>