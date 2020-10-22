<?php

namespace Marvel\Models;

class Details 
{
	protected $comics,
			  $series,
			  $stories,
			  $image,
			  $description,
			  $link;
			  
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

	public function setComics($comics) 
	{
		$this->comics = $comics;
	}	

	public function setSeries($series) 
	{

		$this->series = $series;

    }
    
    public function setStories($stories) 
	{

		$this->stories = $stories;

	}

	public function setImage($image) 
	{

		$this->image = $image;

	}

	public function setDescription($description) 
	{

		$this->description = $description;

	}

	public function setLink($link) 
	{

		$this->link = $link;

	}

// getters

	public function comics() {return $this->comics;}
	public function series() {return $this->series;}
	public function stories() {return $this->stories;}
	public function image() {return $this->image;}
	public function description() {return $this->description;}
	public function link() {return $this->link;}
}