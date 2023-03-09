<?php namespace LLibrary\Models;
class AboutManager extends DBFactory
{
	//Récupération des informations à propos du site
	public function getAboutData($abouDataName)
	{
		$sql ='
		SELECT *
		FROM l_about
		';
		$aboutInfo=NULL;
		$about = array();
		$query = $this->db->query($sql);
		while($data=$query->fetch())
		{
			$about[$data['about_index']] = $data['about_info'];
		}
		$aboutInfo=$about[$abouDataName];
		return $aboutInfo;
	}
	// Hydratation de l'entité About
	public function setAboutData()
	{
		$about   = new LLibrary\Entities\About();
		$about->setWebsiteGoal($this->getAboutData('website_goal'));
		$about->setWelcomeMessage($this->getAboutData('welcome_message'));
		$about->setWelcomePhoto($this->getAboutData('welcome_photographe'));	}
}