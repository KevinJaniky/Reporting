<?php

class Deployement
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

    public function createTable()
    {

        // USERS
        $this->_bdd->query('
            DROP TABLE IF EXISTS `user`;
            CREATE TABLE `user` (
              `id` int(10) NOT NULL,
              `identifiant` varchar(255) NOT NULL,
              `mdp` varchar(255) NOT NULL
            ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
       ');

        $this->_bdd->query('ALTER TABLE `user` ADD PRIMARY KEY (`id`);');
        $this->_bdd->query('ALTER TABLE `user` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;');


        //COMPETENCES


        $this->_bdd->query("
        DROP TABLE IF EXISTS `competences`;
        CREATE TABLE `competences` (
          `id` int(5) NOT NULL,
          `name` varchar(255) NOT NULL
        ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
        ");


        $this->_bdd->query('ALTER TABLE `competences` ADD PRIMARY KEY (`id`);');
        $this->_bdd->query('ALTER TABLE `competences` MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;');



        // REPORTE
        $this->_bdd->query("DROP TABLE IF EXISTS `reporte`;
            CREATE TABLE `reporte` (
              `id` int(11) NOT NULL,
              `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              `competence` int(11) NOT NULL,
              `commentaire` text NOT NULL,
              `titre` varchar(255) NOT NULL,
              `who` int(11) NOT NULL
            ) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
        ");

        $this->_bdd->query('ALTER TABLE `reporte` ADD PRIMARY KEY (`id`);');
        $this->_bdd->query('ALTER TABLE `reporte` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;');


        // PROSPECTION

        $this->_bdd->query("DROP TABLE IF EXISTS `prospection`;
            CREATE TABLE IF NOT EXISTS `prospection` (
              `id` int(10) NOT NULL AUTO_INCREMENT,
              `Nom` varchar(255) NOT NULL,
              `mail` varchar(300) NOT NULL,
              `tel` varchar(10) NOT NULL,
              `adresse` text NOT NULL,
              `code postale` varchar(5) NOT NULL,
              `ville` varchar(255) NOT NULL,
              `who` int(11) NOT NULL,
              `commentaire` text NOT NULL,
              `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=latin1;");

        // CLIENT

        $this->_bdd->query("
        DROP TABLE IF EXISTS `client`;
        CREATE TABLE IF NOT EXISTS `client` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `nom` varchar(255) NOT NULL,
          `prenom` varchar(255) NOT NULL,
          `societe` varchar(255) NOT NULL,
          `mail` varchar(255) NOT NULL,
          `tel` varchar(10) NOT NULL,
          `adresse` text NOT NULL,
          `codepostal` varchar(5) NOT NULL,
          `ville` varchar(255) NOT NULL,
          `who` int(11) NOT NULL,
          `commentaire` text NOT NULL,
          `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
        ");


        // DOCUMENTS

        $this->_bdd->query("
           DROP TABLE IF EXISTS `documents`;
           CREATE TABLE IF NOT EXISTS `documents` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `nom` varchar(255) NOT NULL,
          `path` varchar(255) NOT NULL,
          `client` int(11) NOT NULL,
          `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
        ");







    }

    public function seederTable()
    {

        $this->_bdd->query("
            INSERT INTO `user` (`id`, `identifiant`, `mdp`) VALUES
            (1, 'kevin', 'kevin');
            ");
        $this->_bdd->query("
           INSERT INTO `competences` (`id`, `name`) VALUES
            (1, 'Compétence 1 '),
            (2, 'Compétence numero 2'),
            (3, 'Compétence numero 3');
            ");

    }


}
