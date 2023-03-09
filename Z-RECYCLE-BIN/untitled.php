<?php
	/*public static function checkAccessRights($accessRignt)
	{
		$rights=(isset($_SESSION['rights']))?$_SESSION['rights']:1;
		return ($accessRignt <= intval($rights));
	}*/
	/*public function Avator($_FILES)
	{
		if ($_FILES['avator']['error'] > 0 && !empty($_FILES['avator']['size']))
		{
			//Liste des extensions valides
			$validExtensions=array('jpg', 'jpeg', 'gif', 'png', 'bmp');
			if ($_FILES['avator']['size'] <= self::AVATOR_MAX_SIZE)
			{
				$imageSizes=getimagesize($_FILES['avator']['tmp_name']);
				if ($imageSizes[0] <= self::AVATOR_MAX_WIDTH || $imageSizes[1] <= self::
				AVATOR_MAX_HEIGHT)
				{
					$extensionUpload=strtolower(substr(strrchr($_FILES['avator']['name'], 
					'.') ,1));
					if (in_array($extensionUpload, $validExtensions))
					{
						self::moveAvator($_FILES);
					}
				}
			}
		}
	}
	*/
?>
<?php
$menuManager = new LLibrary\Models\MenuManager($db);
/*$mainItems = $menuManager->getMenu(1);
foreach($mainItems as $cle => $item)
{
	$mainItems[$cle]['link']= $item['link'];
	$mainItems[$cle]['name']= $item['name'];
	$mainItems[$cle]['description']= stripslashes($item['description']);
}*/
?>
<nav>
<ul>
<?php
$menuManager = new LLibrary\Models\MenuManager($db);
foreach($menuManager->getMenu(1) as $item)
{
	?>
    <li>
    <a href="<?php echo ROOTPATH.'/'.$item['link']; ?>" accesskey="<?php echo $item['accessKey'] 
	?>" title="<?php echo $item['description'] ?>">
	<?php echo $item['name']; ?>
    </a>
    </li>
    <?php
}
?>
</ul>
</nav><?php
/*
//$mainItems = $menuManager->getMenu(1);
/*foreach($mainItems as $cle => $item)
{
	$mainItems[$cle]['link']= $item['link'];
	$mainItems[$cle]['name']= $item['name'];
	$mainItems[$cle]['description']= stripslashes($item['description']);
}
foreach ($manager->getList(0, 5) as $news)
	{
		if (strlen($news->content()) <= 200)
		{
			$content = new Content($news->content());
		}
		else
		{
			$text = substr($news->content(), 0, 200);
			$text = substr($debut, 0, strrpos($text, ' ')) . '...';
			$content = General::textStyle($text);
			$content = General::smilies($text);
			$contenu = nl2br($content);
		}
		include('news-list.php');
	}
*/
?>
<?php 
$layout = new LLibrary\General\LayoutController($db, $pt, $id);
//$layout = $layoutManager->setLayout(); instancier avk le constructeur
//$title = new LLibrary\General\Title($pageTitle) instancier avk le constructeur;
//$visitorIP = ip2long($_SERVER['REMOTE_ADDR']) instancier avk le constructeur;		
//$ipManager = new LLibrary\Models\GeoLocalisation($db);
/*$visitor = new LLibrary\Entities\Whosonline(array(
'id'             => $id,
'ip'             => $visitorIP,
'page'           => $pageTitle,
'connectionTime' => time()
));*/
//$ipManager->visitorRegister($visitor);
?>
<?php
$minute = date ('i');
$heure = date ('H');
$counter1 = $ipManager->whosOnline($id);
$counter2 = $ipManager->countVisitors();
$counter3 = $ipManager->countMembers();
$counter4 = $ipManager->countNoMembers();
$counter5 = $ipManager->nowPageVisitors($pageTitle);
?>
<p>
Aujourd'hui à <?php echo $heure.' h '.$minute.'min'; ?> sur <?php echo APPTITLE; ?> :
</p>
<p>
En ligne:<strong><?php echo $counter2->visitorsNumber() ?></strong><img src="/Templates/images/icons/b_usrlist.png"> | membres: 
<strong><?php echo $counter3->membersNumber() ?></strong>
<img src="/Templates/images/icons/s_success.png" /> | 
Visiteur(s): <strong><?php echo $counter4->noMembersNumber() ?></strong>
<img src="/Templates/images/icons/mem.png" /> | Sur cette page : 
<strong><?php echo $counter5->page() ?></strong>
<img src="/Templates/images/icons/dopplr.png" />
</p>