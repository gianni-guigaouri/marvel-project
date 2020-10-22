<?php

require_once ('util/UploadImage.php');

class ControllerAddPersonnage
{
    private $_view;

    public function __construct($url)
    {
        $this->addPersonnage();
    }

    public function addPersonnage() { 
        //INIT MANAGER PDO
        $manager = new Marvel\Models\PersonnagesManagerPDO();
        // IF NAME EXIST CHECK IF NAME IS ALREADY TAKE
        if(isset($_POST['name'])) {
            $name = htmlspecialchars($_POST['name']);
            if($manager->getUniquePersonnageByName($name)){
                $response = 'error name';
                header("Content-type: application/json; charset=utf-8");
                echo json_encode($response);
            } else {
                // CHECK IF FILE PICTURE NOT EMPTY
                if (!empty($_FILES) && isset($_FILES['image']))
                {   
                    // CALL CLASS IMAGE TO VERIFY THE FILE
                    $picture = new UploadImage();
                    $sendPicture = $picture->validImageRecipe($_FILES['image'], $name);
                    // IF RETURN IMAGE CREATE PERSONNAGE
                    if ($sendPicture)
                    {
                        $addPerso = new Marvel\Models\Personnages(
                        [
                            'name' => $name,
                            'image' => 'http://localhost:8888/public/img/personnages/'.$sendPicture
                        ]);
                        $manager->addPersonnages($addPerso);
                        $response = 'success';
                        header("Content-type: application/json; charset=utf-8");
                        echo json_encode($response);

                    } else {
                        $response = 'image';
                        header("Content-type: application/json; charset=utf-8");
                        echo json_encode($response);
                    } 
                }
                else {
                    $response = 'image';
                    header("Content-type: application/json; charset=utf-8");
                    echo json_encode($response);
                }
            }
        }
    }
}