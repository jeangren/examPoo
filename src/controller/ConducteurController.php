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
}