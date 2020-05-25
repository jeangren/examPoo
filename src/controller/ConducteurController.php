<?php
namespace App\Controller;

use App\Model\Conducteur;

class ConducteurController extends AbstractController {

    public static function index() {
        $conducteurs = Conducteur::findAll();

        echo self::getTwig()->render('conducteur/index.html', [
            'conducteurs' => $conducteurs
        ]);
    }

    public static function create() {
        echo self::getTwig()->render('conducteur/create.html');
    }

    public static function new() {
        $conducteur = new Conducteur;
        $conducteur->setPrenom($_POST['prenom']);
        $conducteur->setNom($_POST['nom']);
        $conducteur->store();

        self::index();
    }

}