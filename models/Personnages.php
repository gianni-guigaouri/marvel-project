<?php

namespace Marvel\Models;

class Personnages 
{
	protected $id,
			  $persoId,
			  $image,
			  $name;
			  
	public function __construct($value = []) 
	{
		if(!empty($value))
		{
			$this->hydrate($value);
		}
	}

	public function hydrate($data) 
	{
		foreach ($data as $attribut => $value) 
		{
			$methode = 'set'.ucfirst($attribut);
			if(is_callable([$this, $methode]))
			{
				$this->$methode($value);
			}
		}
	}

// setter

	public function setId($id) 
	{
		$this->id = (int) $id;
	}

	public function setPersoId($persoId) 
	{
		$this->persoId = (int) $persoId;
	}

	public function setImage($image) 
	{
		$this->image = $image;
	}	

	public function setName($name) 
	{

		$this->name = $name;

	}

// getters

	public function id() {return $this->id;}
	public function persoId() {return $this->persoId;}
	public function image() {return $this->image;}
	public function name() {return $this->name;}
}