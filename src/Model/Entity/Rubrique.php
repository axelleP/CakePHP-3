<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Rubrique extends Entity
{
    //permission ou non de modifier les champs suivants
    protected $_accessible = [
        '*' => false,//non par défaut à tous les champs
        'nom' => true,
        'descriptif' => true,
    ];
}