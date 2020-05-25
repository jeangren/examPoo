<?php

namespace App\Model;

use PDO;

class Vehicule extends AbstractModel {

    /**
     * @var int
     */
    private $id_vehicule;

    /**
     * @var string
     */
    private $marque;

    /**
     * @var string
     */
    private $modele;

/**
     * @var string
     */
    private $couleur;

    /**
     * @var string
     */
    private $immatriculation;

    /**
     * Nom de la table en BDD
     * On le met en public car il n'a pas besoin d'avoir de Getter (en effet la donnée est écrite en "dur")
     * 
     * @var string
     */
    public $tableName = "vehicule";

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id_vehicule;
    }

    /**
     * @param int $id
     * @return self
     */
    public function setId(int $id)
    {
        $this->id_vehicule = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getMarque() : string
    {
        return $this->marque;
    }

    /**
     * @param string $marque
     * @return self
     */
    public function setMarque(string $marque)
    {
        $this->marque = $marque;
        return $this;
    }

    /**
     * @return string
     */
    public function getModele() : string
    {
        return $this->modele;
    }

    /**
     * @param string $modele description du paramètre
     * @return self
     */
    public function setModele(string $modele) : self
    {
        $this->modele = $modele;
        return $this;
    }


       /**
     * @return string
     */
    public function getCouleur() : string
    {
        return $this->couleur;
    }

    /**
     * @param string $couleur description du paramètre
     * @return self
     */
    public function setCouleur(string $couleur) : self
    {
        $this->couleur = $couleur;
        return $this;
    }


       /**
     * @return string
     */
    public function getImmatriculation() : string
    {
        return $this->immatriculation;
    }

    /**
     * @param string $immatriculation description du paramètre
     * @return self
     */
    public function setImmatriculation(string $immatriculation) : self
    {
        $this->immatriculation = $immatriculation;
        return $this;
    }
    
      

    public static function findAll() {
        $pdo = self::getPdo();

        $query = 'select * from vehicule';

        $response = $pdo->prepare($query);
        $response->execute();

        $data = $response->fetchAll();

        $dataAsObjects = [];

        
        foreach($data as $d) {
            $dataAsObjects[] = self::toObject($d);
        }

        return $dataAsObjects;
    }


    
    public static function findOne($id) {
        $pdo = self::getPdo();

        $query = 'SELECT * FROM vehicule WHERE id = :id';

        $response = $pdo->prepare($query);
        $response->execute([
            'id' => $id,
        ]);

        $data = $response->fetch();

        $dataAsObject = self::toObject($data);

        return $dataAsObject;
    }
    
    public static function toObject($array) {

        $vehicule = new Vehicule;
        $vehicule->setId($array['id_vehicule']);
        $vehicule->setMarque($array['marque']);
        $vehicule->setModele($array['modele']);
        $vehicule->setModele($array['couleur']);
        $vehicule->setModele($array['immatriculation']);

        return $vehicule;
    }

    
    public function store() {

        $pdo = self::getPdo();

        $query = 'INSERT INTO vehicule(marque, modele, couleur, immatriculation) VALUES (:marque, :modele, :couleur, :immatriculation)';

        $response = $pdo->prepare($query);
        $response->execute([
            'marque' => $this->getMarque(),
            'modele' => $this->getModele(),
            'couleur' => $this->getCouleur(),
            'immatriculation' => $this->getImmatriculation()

        ]);

        return true;
    }
}