<?php
namespace LLibrary\Models;
class Config extends DBFactory
{
	public $configData;
	public function __construct($configValue)
	{
		$this->setConfigData($configValue);
	}
	public function setConfigData($configIndex)
	{
		$configValue=NULL;
		$config = array();
		$query = $this->db->query('
		SELECT *
		FROM l_config
		');
		while($data=$query->fetch())
		{
			$config[$data['config_index']] = $data['config_value'];
		}
		$configValue=$config[$configIndex];
		$this->configData=$configValue;
	}
	public function configValue(){ return $this->configData; }
}