<?php

class Client
{
    private $_bdd;
    private $_error = '';

    public function __construct()
    {
        require_once __DIR__ . '/../env.php';

        try {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $this->_bdd = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';charset=utf8', USER, MDP, $pdo_options);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function prospectToClient($data, $who)
    {
        $query = $this->_bdd->prepare('INSERT INTO client (
        societe ,mail,tel,adresse,codepostal,ville,who,commentaire) VALUES (
        :societe,:mail,:tel,:adresse,:cp,:ville,:who,:com)');

        $query->execute([
            'societe' => $data['Nom'],
            'mail' => $data['mail'],
            'tel' => $data['tel'],
            'adresse' => $data['adresse'],
            'cp' => $data['code postale'],
            'ville' => $data['ville'],
            'who' => $who,
            'com' => $data['commentaire']
        ]);
    }

    public function findClientByMail($mail)
    {
        $query = $this->_bdd->query('SELECT * FROM client WHERE mail ="' . $mail . '"');
        $data = $query->fetch();
        if (empty($data))
            return true;
        return false;
    }

    public function readAll(){
        $query = $this->_bdd->query('SELECT * FROM client');
        return $query->fetchAll();
    }

    public function findId($mail){
        $query = $this->_bdd->query('SELECT id FROM client WHERE mail = "'.$mail.'"');
        return $query->fetch();
    }

    public function search($val){
        $query = $this->_bdd->query("
            SELECT * FROM client WHERE societe LIKE '".$val."%'
            UNION
            SELECT * FROM client WHERE nom LIKE '".$val."%'
            UNION
            SELECT * FROM client WHERE prenom LIKE '".$val."'; ");
        return $query->fetchAll();
    }
}