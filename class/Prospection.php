<?php

class Prospection
{
    private $_bdd;
    private $_nom;
    private $_mail;
    private $_tel;
    private $_adress;
    private $_cp;
    private $_ville;
    private $_com;
    private $_error = '';

    public function __construct()
    {
        require_once __DIR__ . '/../env.php';

        try {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $this->_bdd = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';charset=utf8', USER, MDP);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function setNom($nom)
    {
        if (strlen($nom) > 2) {
            return $this->_nom = $nom;
        }
        return $this->_error .= '<li>Nom Trop court</li>';
    }

    public function setMail($mail)
    {
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            return $this->_mail = $mail;
        }
        return $this->_error .= '<li>Mail non valide</li>';
    }

    public function setTel($tel)
    {
        $pattern = '/^[0-9]{10}$/';
        if (preg_match($pattern, $tel)) {
            return $this->_tel = $tel;
        }
        return $this->_tel = 'Non renseigné';
    }

    public function setAdress($add)
    {
        if (strlen($add) > 5) {
            return $this->_adress = $add;
        }
        return $this->_adress = 'Non renseigné';
    }

    public function setVille($ville)
    {
        if (strlen($ville) > 2) {
            return $this->_ville = $ville;
        }
        return $this->_error .= '<li>Ville Trop court</li>';
    }


    public function setCom($com)
    {
        if (strlen($com) > 2) {
            return $this->_com = $com;
        }
        return $this->_com = 'Aucun commentaire';
    }

    public function setCp($cp)
    {
        $pattern = '/^[0-9]{5}$/';
        if (preg_match($pattern, $cp)) {
            return $this->_cp = $cp;
        }
        return $this->_error .= '<li>Code postal non valide</li>';
    }

    public function create($who)
    {
        if (empty($this->_error)) {
            $query = $this->_bdd->prepare('
            INSERT INTO prospection
             (nom,mail,tel,adresse,`code postale`,ville,who,commentaire,create_at) VALUES
             (:nom,:mail,:tel,:adresse,:code,:ville,:who,:com,:create_at)');

            $query->execute([
                'nom' => $this->_nom,
                'mail' => $this->_mail,
                'tel' => $this->_tel,
                'adresse' => $this->_adress,
                'code' => $this->_cp,
                'ville' => $this->_ville,
                'who' => $who,
                'com' => $this->_com,
                'create_at'=>date('Y-m-d 00:00:00')
            ]);
            return true;
        }

        return $this->_error;
    }

    public function update($id,$who)
    {
        if (empty($this->_error)) {
           $query = $this->_bdd->prepare('UPDATE prospection SET
              Nom = :nom,mail = :mail,tel = :tel,adresse = :tel,`code postale` = :code,
              ville = :ville,who = :who,commentaire = :com WHERE id = :id
');

           $query->execute([
               'nom' => $this->_nom,
               'mail' => $this->_mail,
               'tel' => $this->_tel,
               'adresse' => $this->_adress,
               'code' => $this->_cp,
               'ville' => $this->_ville,
               'who' => $who,
               'com' => $this->_com,
               'id'=> $id
           ]);
        }
        return $this->_error;
    }

    public function readToday()
    {
        $d = date('Y-m-d 00:00:00');
        $query = $this->_bdd->query('SELECT * FROM prospection WHERE create_at = "' . $d . '"');
        return $query->fetchAll();
    }

    public function deleteOne($id)
    {
        $this->_bdd->query('DELETE FROM prospection WHERE id =' . $id);
    }

    public function readAll(){
        $query = $this->_bdd->query('SELECT * FROM prospection ORDER BY create_at');
        return $query->fetchAll();
    }

    public function readOne($id){
        $query = $this->_bdd->query('SELECT * FROM prospection WHERE id = '.$id);
        $data = $query->fetch();
        if(!empty($data)){
            return $data;
        }
        return false;
    }
}