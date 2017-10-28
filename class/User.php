<?php

class User
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

    public function getUser($id, $mdp)
    {
        $query = $this->_bdd->query('SELECT * FROM user WHERE identifiant = "' . $id . '" AND mdp = "' . $mdp . '"');
        $query = $query->fetch();
        if (empty($query)) {
            return false;
        }
        return $query;
    }

    public function isConnected()
    {
        if (isset($_SESSION['connected'])) {
            if ($_SESSION['connected'] === true)
                return true;
            return false;
        }
        return false;
    }

    public function createSession($id){
        $_SESSION['connected'] = true;
        $_SESSION['id'] = $id;
    }

}