<?php

session_start();

class ControllerHome
{
    private $_view;

    public function __construct($url)
    {
        $this->homePage();
    }

    public function homePage()
    {   //INIT MANAGER PDO
        $manager = new Marvel\Models\PersonnagesManagerPDO();  
        // CHECK PAGE NUMBER
        $currentPage = 1;
        // CALL VIEW 
        $this->_view = new View('Home');
        $this
            ->_view
            ->generate(array(
                'currentPage' => $currentPage
        ));
    }
}