<?php

namespace App\Model;

use PDO;

class Conducteur extends AbstractModel {

    /**
     * @var int
     */
    private $id_conducteur;

    /**
     * @var string
     */
    private $prenom;

    /**
     * @var string
     */
    private $nom;

    /**
     * Nom de la table en BDD
     * On le met en public car il n'a pas besoin d'avoir de Getter (en effet la donnée est écrite en "dur")
     * 
     * @var string
     */
    public $tableName = "conducteur";

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id_conducteur;
    }

    /**
     * @param int $id
     * @return self
     */
    public function setId(int $id)
    {
        $this->id_conducteur = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrenom() : string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     * @return self
     */
    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return string
     */
    public function getNom() : string
    {
        return $this->nom;
    }

    /**
     * @param string $nom description du paramètre
     * @return self
     */
    public function setNom(string $nom) : self
    {
        $this->nom = $nom;
        return $this;
    }

    public static function findAll() {
        $pdo = self::getPdo();

        $query = 'select * from conducteur';

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

        $query = 'SELECT * FROM conducteur WHERE id = :id';

        $response = $pdo->prepare($query);
        $response->execute([
            'id' => $id,
        ]);

        $data = $response->fetch();

        $dataAsObject = self::toObject($data);

        return $dataAsObject;
    }
    
    public static function toObject($array) {

        $conducteur = new Conducteur;
        $conducteur->setId($array['id_conducteur']);
        $conducteur->setPrenom($array['prenom']);
        $conducteur->setNom($array['nom']);

        return $conducteur;
    }

    
    public function store() {

        $pdo = self::getPdo();

        $query = 'INSERT INTO conducteur(prenom, nom) VALUES (:prenom, :nom)';

        $response = $pdo->prepare($query);
        $response->execute([
            'prenom' => $this->getPrenom(),
            'nom' => $this->getNom()
        ]);

        return true;
    }
}