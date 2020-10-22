<?php

require_once('./util/Api.php');

class ControllerApi
{
    private $_view;

    public function __construct($url)
    {
        $this->apiPage();
    }

    public function apiPage() { 
        //INIT MANAGER PDO
        $manager = new Marvel\Models\PersonnagesManagerPDO();
        // COUNT API DATA
        $countApi = new Api();
        $countApi->countDataApi();
        // GET NUMBER OF PERSONNAGES
        $countApiNb = $countApi->number()['data']['total'];
        // DATA FOR FOR INIT PERSONNAGES PER PAGE
        $personnagesByPage = 12;
        $nbPage = ceil($countApiNb / $personnagesByPage);
        // BDD COUNT 
        $countBdd = $manager->count();
        $nbPageBdd = ceil($countBdd / $personnagesByPage);

        // CHECK IF ALL DATA FROM API EXIST IN BDD ELSE PUT DATA
        if($nbPageBdd < $nbPage) {
            // LIKE LIMIT IS 100 PERSONNAGES, "FOR" WITH SYSTEM OF PAGE 
            // FOR CHANGE THE START POSITION
            for ($page = 1; $page < $nbPage; $page++) {
                $start = ($page - 1) * $personnagesByPage;
                $personnages = new Api;   
                $personnages->getDataApi(100, $start);
                $listOfPersonnagesFromApi = $personnages->response()['data']['results'];

                // CHECK IF PERSONNAGE EXIST
                foreach($listOfPersonnagesFromApi as $personnage) {
                    $count = $manager->countWithPersoId($personnage['id']);
                    if($count > 0) {
                        $res = 'Ce personnage a déjà été ajouté.';
                    } else {
                        // CREATE THE PERSONNAGES 
                        $addPerso = new Marvel\Models\Personnages(
                        [
                        'persoId' => $personnage['id'],
                        'name' => $personnage['name'],
                        'image' => $personnage['thumbnail']['path']. '/standard_fantastic.' . $personnage['thumbnail']['extension'],
                        'description' => $personnage['description']
                        ]);
                        // ADD IN BDD
                        $manager->addPersonnages($addPerso);
                    }
                }            
            }
            $response['success'] = 'Tous les personnages ont été ajoutés.';
        } else {
            $response['message'] = 'Tous les personnages ont déjà été ajoutés.';
        }
        // SEND JSON RESPONSE
        header("Content-type: application/json; charset=utf-8");
        http_response_code(200);
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}