<?php

namespace Marvel\Models;

use Marvel\Models\DBFactory;
use Marvel\Models\Personnages;


// use PDO;

class PersonnagesManagerPDO
{

	protected $db;

	public function __construct() 
	{
		$this->db = DBFactory::getMySqlConnexionWithPDO();
	}	

	
	public function addPersonnages(Personnages $personnages) 
	{	
		$request = $this->db->prepare('INSERT INTO personnages(persoId, image, name) VALUES(:persoId, :image, :name)');

		$request->bindValue(':persoId', $personnages->persoId());
		$request->bindValue(':image', $personnages->image());
		$request->bindValue(':name', $personnages->name());
		$request->execute();
	}

	public function list($personnagesByPage, $start)
	{
		$request = $this->db->prepare('SELECT * FROM personnages ORDER BY id DESC LIMIT :start, :personnagesByPage');
		$request->bindValue(':start', (int) $start, \PDO::PARAM_INT);
		$request->bindValue(':personnagesByPage', (int) $personnagesByPage, \PDO::PARAM_INT);
		$request->execute();

		$request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Marvel\Models\Personnages');
		$listPersonnages = $request->fetchAll();
		return $listPersonnages;
	}


	public function getUniquePersonnageByName($name)
	{
		$request = $this->db->prepare('SELECT * FROM personnages WHERE name = :name');		
		$request->bindValue(':name', $name);
		$request->execute();
		$request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Marvel\Models\Personnages');
		$personnage = $request->fetch();
		return $personnage;
	}

	public function countWithPersoId($persoId) 
	{
		$request = $this->db->prepare('SELECT COUNT(*) FROM personnages WHERE persoId = :persoId');
		$request->bindValue(':persoId', $persoId);
		$request->execute();
		$countPersonnages = $request->fetchColumn();
		return $countPersonnages;
	}

	public function count() 
	{
		$request = $this->db->prepare('SELECT COUNT(*) FROM personnages');
		$request->execute();
		$countPersonnages = $request->fetchColumn();
		return $countPersonnages;
	}

}