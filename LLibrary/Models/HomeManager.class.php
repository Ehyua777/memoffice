<?php namespace LLibrary\Models;
class HomeManager extends DBFactory
{
	//Récupération des informations à propos du site
	public function getHomeData($homeId)
	{
		$sql ='
		SELECT home_id id, home_welcomeMessage welcomeMessage, 
		home_welcomePhoto welcomePhoto, home_websiteGoal websiteGoal
		FROM l_home
		WHERE home_id = :id
		';
		$query = $this->db->prepare($sql);
		$query->bindValue(':id', $homeId, \PDO::PARAM_INT);
		$query->execute() or die(print_r($db->errorInfo()));
		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 
		'\LLibrary\Entities\Home');
		return $query->fetch();
	}
}