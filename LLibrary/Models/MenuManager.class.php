<?php
namespace LLibrary\Models;
class MenuManager extends DBFactory
{
	public function getMenu($level)
	{
		try
		{
			$sql = '
			SELECT item_id accessKey, item_link link, item_name name, item_description 
			description, item_level level
			FROM l_menu_items
			WHERE item_level = :level
			';
			$query = $this->db->prepare($sql);
			$query->bindValue(':level', $level, \PDO::PARAM_INT);
			$query->execute() or die(print_r($db->errorInfo()));
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 
			'\LLibrary\Entities\Menu');
			$menu = $query->fetchAll();
			return $menu;
		}
		catch (\Exception $err)
		{
			die ('error['.$err->getCode().'] '.$err->getMessage());
		}
	}
}