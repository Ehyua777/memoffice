<?php
$member = new LLibrary\Entities\Member();
//Vérification des données soumis par le formulaire
if (isset($_FILES['avator']) && !empty($_POST['avator']))
{
	extract($_POST);
	$avatorAlert = $member->checkAvator($_FILES['avator']);
	if ($avatorAlert['alert'] == 0)
	{
		$member->moveAvator($_FILES['avator'], $config->avatorDir());
		$member->setId($id);
		$userManager->updateAvator($member);
	}	
}
include('../Pages/members/avator-form.php');
function ab()
		{
		
			$fileSizes=getimagesize($avator['tmp_name']);
			$validExtensions=array('jpg', 'jpeg', 'gif', 'png', 'bmp');
			$extensionUpload=strtolower(substr(strrchr($avator['name'],'.') ,1));
			if ($avator['error'] > 0 && empty($avator['size']))
			{
				return self::LOARDING_ERROR;
			}
			if ($avator['size'] > self::AVATOR_MAX_SIZE)
			{
				return self::AVATOR_TOO_HEAVY;
			}
			if ($fileSizes[0]>self::AVATOR_MAX_WIDTH || $fileSizes[1]>
			self::AVATOR_MAX_HEIGHT)
			{
				return self::SIZE_ERROR;
			}
			if (!in_array($extensionUpload, $validExtensions))
			{
				return self::INVALID_EXTENSION;
			}
		}
?>