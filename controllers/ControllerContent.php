<?php

session_start();

class ControllerContent
{
    private $_view;

    public function __construct($url)
    {
        $this->contentPage();
    }

    public function contentPage() { 
        //INIT MANAGER PDO
        $manager = new Marvel\Models\PersonnagesManagerPDO();
         // COUNT BDD
        $count = $manager->count();
        $totalPersonnages = $count;
        // DATA FOR PAGINATION
        $personnagesByPage = 12;
        // SET THE PAGE NUMBER FOR THE PAGINATION
        $currentPage = (!isset($_GET['page'])) ? 1 : $_GET['page'];
        $_SESSION['currentPage'] = $_GET['page'];
        $start = ($currentPage - 1) * $personnagesByPage;
        $nbPage = ceil($totalPersonnages / $personnagesByPage); // calcul of entier number 
        $prev = $currentPage - 1;
        $next = $currentPage + 1;
        // GET LIST OF PERSONNAGES FROM BDD
        $listPersonnages = $manager->list($personnagesByPage, $start);
        // SHOW VIEW PAGINATION TO REPLACE CONTENT--CONTAINER
        require ('views/viewContent.php');
    }
}