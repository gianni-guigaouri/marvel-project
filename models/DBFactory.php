<?php
namespace Marvel\Models;

class DBFactory
{
	public static function getMySqlConnexionWithPDO()
	{
		$db = new \PDO('mysql:host=localhost;dbname=Marvel;charset=utf8', 'root', 'root');
		$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		return $db;
	}
}