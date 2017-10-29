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

    public function readAll()
    {
        $query = $this->_bdd->query('SELECT * FROM client');
        return $query->fetchAll();
    }

    public function findId($mail)
    {
        $query = $this->_bdd->query('SELECT id FROM client WHERE mail = "' . $mail . '"');
        return $query->fetch();
    }

    public function search($val)
    {
        $query = $this->_bdd->query("
            SELECT * FROM client WHERE societe LIKE '" . $val . "%'
            UNION
            SELECT * FROM client WHERE nom LIKE '" . $val . "%'
            UNION
            SELECT * FROM client WHERE prenom LIKE '" . $val . "'; ");
        return $query->fetchAll();
    }

    public function readOne($id)
    {
        $query = $this->_bdd->query('SELECT * FROM client WHERE id = ' . $id);
        $data = $query->fetch();
        if (!empty($data)) {
            return $data;
        }
        return false;
    }

    public function modify($data)
    {
        $query = $this->_bdd->prepare('UPDATE client SET 
          nom = :nom,
          prenom = :prenom,
          societe = :societe,
          mail = :mail,
          tel = :tel,
          adresse = :adresse,
          codepostal = :cp,
          ville = :ville
          WHERE id = :id');
        $query->execute([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'societe' => $data['societe'],
            'mail' => $data['mail'],
            'tel' => $data['tel'],
            'adresse' => $data['adresse'],
            'cp' => $data['cp'],
            'ville' => $data['ville'],
            'id' => $data['id']
        ]);
    }

    public function modifyCom($com,$id){
        $this->_bdd->query('UPDATE client SET commentaire = "'.$com.'" WHERE id = '.$id);
    }

    public function addDoc($nom,$path,$id){
        $query = $this->_bdd->prepare('INSERT INTO documents (nom,path,client) VALUES (:nom,:path,:id)');
        $query->execute([
           'nom'=>$nom,
            'path'=>$path,
            'id'=>$id
        ]);
    }

    public function readDoc($id){
        $query = $this->_bdd->query('SELECT * FROM documents WHERE client ='.$id);
        return $query->fetchAll();
    }
}