<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Article extends Entity
{
    //permission ou non de modifier les champs suivants
    protected $_accessible = [
        '*' => false,//non par défaut à tous les champs
        'rubrique_id' => true,
        'dateCreation' => true,
        'titre' => true,
        'descriptif' => true,
        'contenu' => true,
    ];
}