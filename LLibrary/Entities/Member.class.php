<?php namespace LLibrary\Entities;
class Member extends Visitor
{
	// Les constantes
	const AVATOR_MAX_SIZE   = 25000;
	const AVATOR_MAX_WIDTH  = 200;
	const AVATOR_MAX_HEIGHT = 200;
	const LOARDING_ERROR    = 1;
	const AVATOR_TOO_HEAVY  = 2;
	const INVALID_EXTENSION = 3;
	const SIZE_ERROR        = 4;
	const AVATOR_DIR        = '';
	
	static $extentionError = 'Extension de la photo incorrecte';
	static $loadingError   = 'Erreur lors du transfert de la photo';
	static $emptyFile      = 'Fichier vide';
	
	// Vérification du pseudo
	public function checkPseudo()
	{
		return !empty($this->pseudo);
	}
	// Vérification du mot de passe
	public function checkPasword()
	{
		return !empty($this->test1) && !empty($this->test2) && 
		$this->test1 == $this->test2; 
	}
	public function setPasword()
	{
		$this->test2 = sha1($this->test1);
		$this->setPw($this->test2); 
		 
	}
	//Vérification de l'avatar
	public function checkAvator(array $file)
	{
		$alert=0;
		$fileErr=NULL;
		$fileAlert=array();
		$fileSizes = array();
		//Vérification de la photo
		if (!empty($file['size']))
		{
			$fileSizes=getimagesize($file['tmp_name']);
			$validExtensions=array('jpg', 'jpeg', 'gif', 'png', 'bmp');
			$extensionUpload=strtolower(substr(strrchr($file['name'], '.'), 1));
			//Liste des extensions valides
			if ($file['error'] > 0)
			{
				$alert++;
				$fileErr = self::$loadingError;
			}
			if ($file['size'] > self::AVATOR_MAX_SIZE)
			{
				$alert++;
				$fileErr = 'Le fichier est trop gros : 
				(<strong>'.$file['size'].'Octets</strong> contre <strong>
				'.self::AVATOR_MAX_SIZE.' Octets</strong>)';
			}
			if ($fileSizes[0] > self::AVATOR_MAX_WIDTH || 
			$fileSizes[1] > self::AVATOR_MAX_HEIGHT)
			{
				$alert++;
				$fileErr = 'Image trop large ou trop longue :(<strong>
				'.$fileSizes[0].'x'.$fileSizes[1].'</strong> contre <strong>
				'.self::AVATOR_MAX_WIDTH.'x'.self::AVATOR_MAX_HEIGHT.'</strong>)';
			}
			if (!in_array($extensionUpload, $validExtensions))
			{
				$alert++;
				$fileErr = self::$extentionError;
			}
		}
		else
		{
			$alert++;
			$fileErr = self::$emptyFile;
		}
		$fileAlert=array(
		'alert' => $alert, 
		'error' => $fileErr
		);
		return $fileAlert;
	}
	//Chargement de l'avatar
	public function moveAvator(array $avator, $directory)
	{
		$directory =__DIR__.'/../../'.$directory.'/';
		$extensionUpload=strtolower(substr(strrchr($avator['name'], '.'), 1));
		$name = time();
		$fileName = str_replace(' ', '', $name).'.'.$extensionUpload;
		$name=$directory.str_replace('', '', $name).'.'.$extensionUpload;
		move_uploaded_file($avator['tmp_name'], $name);
		$this->setAvator($fileName);
	}
}