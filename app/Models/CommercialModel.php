<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class CommercialModel extends Model{
    protected $table = 'COMMERCIAL';
    
    protected $allowedFields = [
        'ID_COMMERCIAL',
        'LOGIN',
        'PASSWORD',
        'NOM',
        'PRENOM'
    ];
}