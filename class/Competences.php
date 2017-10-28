<?php

class Competences
{

    private $_bdd;

    public function __construct()
    {
        require_once __DIR__ . '/../env.php';

        try {
            $this->_bdd = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';charset=utf8', USER, MDP);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function read(){
        $query = $this->_bdd->query("SELECT * FROM competences");
        return $query->fetchAll();
    }

}
