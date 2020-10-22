<?php

session_start();

require_once ('./api/util/Api.php');

class ControllerPersonnage
{
    private $_view;

    public function __construct($url)
    {
        $this->personnagePage();
    }

    public function personnagePage()
    {   //INIT MANAGER PDO
        $manager = new Marvel\Models\PersonnagesManagerPDO();
        // INIT CLASS 
        $details = new Marvel\Models\Details();
        
        // CHECK IF ID EXIST AND IF IS NUMERIC
        if(isset($_GET['id']) && is_numeric($_GET['id'])) {
            // GET INFO FROM BDD 
            $personnage = $manager->getUniquePersonnageById($_GET['id']);
            if ($personnage) {
                $this->_view = new View('Personnage');

                // IF PERSOID THEN PERSO COME FROM MARVEL API  
                if($personnage->persoId() !== null) {
                    $image = str_replace('standard_fantastic', 'portrait_incredible', $personnage->image());
                    $apiData = new Api();
                    // CALL API AND GET DETAILS FROM PERSONNAGES 
                    $apiData->getPersonnageApi($personnage->persoId());
                    $persoApiData = $apiData->response();
                    $comics = $persoApiData['data']['results'][0]['comics']['items'];
                    $series = $persoApiData['data']['results'][0]['series']['items'];
                    $stories = $persoApiData['data']['results'][0]['stories']['items'];
                    $description = $persoApiData['data']['results'][0]['description'];
                    $link = $persoApiData['data']['results'][0]['urls'][1]['url'];
                    // PUT DATA IN DETAILS OBJECT
                    $details = new Marvel\Models\Details([
                        'comics' => $comics,
                        'series' => $series,
                        'stories' => $stories,
                        'image' => $image,
                        'description' => $description,
                        'link' => $link
                    ]);
                    $this
                    ->_view
                    ->generate(array(
                        'personnage' => $personnage,
                        'details' => $details,
                    ));

                } else {
                    $this
                    ->_view
                    ->generate(array(
                        'personnage' => $personnage,
                        'details' => $details
                    ));
                } 
            } else {
                header('Location: http://localhost:8888');
            }       
        } else {
            header('Location: http://localhost:8888');
        }
    }
}