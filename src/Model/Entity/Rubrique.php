<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Rubrique extends Entity
{
    //permission de modifier les champs suivants
    protected $_accessible = [
        'nom' => true,
        'descriptif' => true,
        '*' => false,//non permis pour les autres
    ];
}