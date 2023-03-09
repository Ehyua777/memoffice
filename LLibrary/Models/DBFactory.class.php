<?php
namespace LLibrary\Models;
class DBFactory
{
	protected $db;
	//Définition des constantes
	const HOST = 'localhost';
	const PORT = 3306;
	const DB   = 'mem_office';
	const USER = 'root';
	const PW   = '';
	//Fonction de connection à la base de données via PDO
	public static function getMysqlConnexionWithPDO()
	{
		try
		{
			$db = new \PDO('mysql:
			host='.self::HOST.';
			port='.self::PORT.';
			dbname='.self::DB, self::USER, self::PW
			);
			$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}
		catch (\Exception $err)
		{
			die ('error['.$err->getCode().'] '.$err->getMessage());
		}
		return $db;
	}
	public function setDb($dataBase)
	{
		$dataBase = self::getMysqlConnexionWithPDO();
		$this->db = $dataBase;
	}
	public function __construct($dataBase)
	{
		$this->setDb($dataBase);
	}
	//Fonction de connection à la base de données via PMYSQLi
	public static function getMysqlConnexionWithMySQLi()
	{
		return new \MySQLi(self::HOST, self::USER, self::PW, self::DB, self::PORT);
	}
	public function db() { return $this->db;}
}