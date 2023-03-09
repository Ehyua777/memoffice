<?php
namespace LLibrary\Models;
class LayoutManager extends DBFactory
{
	//Récupération des informations à propos du site
	public function setLayout()
	{
		$sql = '
		SELECT layout_appTitle appTitle, layout_websiteDescription websiteDescription, 
		layout_signature signature, layout_lumbreraSignature lSignature
		FROM l_layout
		';
		$query = $this->db->prepare($sql);
		$query->execute() or die(print_r($db->errorInfo()));
		$layout = $query->fetch(\PDO::FETCH_ASSOC);
		return new \LLibrary\Entities\Layout($layout);
	}
}