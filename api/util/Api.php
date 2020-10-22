<?php 

class Api {

    protected 
    $number,
    $response;

    public function setNumber($number) {
		$this->number = $number;
    }	
    
    public function setResponse($response) {
		$this->response = $response;
    }	
    

    public function getDataApi ($limit, $offset) {
        // FETCH DATA FROM MARVEL API TO HAVE PERSONNAGES
        $url = 'https://gateway.marvel.com/v1/public/characters?ts=1&apikey=cf33a4e187bfb9fa9ee16c5542f2aa51&hash=a31d656247e5500362812df88c4ac147&limit='.$limit.'&offset='.$offset;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($curl), true);
        $this->setResponse($response);
        curl_close($curl);
    }

    public function countDataApi () {
        // FETCH DATA TO CALCULATE THE NUMBER TOTAL OF PERSONNAGES
        $url = 'https://gateway.marvel.com/v1/public/characters?ts=1&apikey=cf33a4e187bfb9fa9ee16c5542f2aa51&hash=a31d656247e5500362812df88c4ac147';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $count = json_decode(curl_exec($curl), true);
        $this->setNumber($count);
        curl_close($curl);
    }

    public function getPersonnageApi ($personnageId) {
        // FETCH DATA OF SINGLE PERSONNAGE 
        $url = 'https://gateway.marvel.com/v1/public/characters/'.$personnageId.'?ts=1&apikey=cf33a4e187bfb9fa9ee16c5542f2aa51&hash=a31d656247e5500362812df88c4ac147';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($curl), true);
        $this->setResponse($response);
        curl_close($curl);
    }

    public function number() {return $this->number;}
    public function response() {return $this->response;}
}
?>