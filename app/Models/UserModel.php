<?php namespace App\Models;

use CodeIgniter\Model;


class UserModel extends Model
{
    // Le nom de la table MySQL
    protected $table = 'CLIENT';

    // Les champs modifiables
    protected $allowedFields = [
        "NOM",
        "PRENOM",
        "VILLE"
    ];
}