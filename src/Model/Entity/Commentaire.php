<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Commentaire extends Entity
{
    //interdiction de modifier les champs
    protected $_accessible = [
        '*' => false,//non par défaut à tous les champs
        'article_id' => true,
        'commentaire_id' => true,
        'user_id' => true,
        'commentaire' => true,
        'dateCreation' => true,
    ];

    //exemple de get
    public function _getDateCreation($attribute) {
        return $attribute;
    }
}