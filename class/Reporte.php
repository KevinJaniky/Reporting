<?php

class Reporte
{

    private $_bdd;
    private $_date;
    private $_competence;
    private $_commentaire;
    private $_error = '';

    public function __construct()
    {
        require_once __DIR__ . '/../env.php';

        try {
            $this->_bdd = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';charset=utf8', USER, MDP);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function setDate($date)
    {
        $d = date('Y-m-d H:i:s', strtotime($date));
         return $this->_date = $d;
        //return $this->_error = 'Date non conforme';
    }

    public function setCompetence($id)
    {
        if (is_int($id))
            return $this->_competence = $id;
        return $this->_error = 'Competence non conforme';
    }

    public function setCommentaire($com)
    {
        if (strlen($com) > 5) {
            return $this->_commentaire = $com;
        }
        return $this->_error = 'Commentaire trop court';
    }

    public function create()
    {
        if (empty($this->_error)) {
            $this->_bdd->query('INSERT INTO reporte(date, competence,commentaire) VALUES ("'.$this->_date.'",'.$this->_competence.',"'.$this->_commentaire.'" )');
            return true;
        }
        return $this->_error;
    }

}