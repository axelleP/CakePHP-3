<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Commentaire extends Entity
{
    //interdiction de modifier les champs
    protected $_accessible = ['*' => false];

    //exemple de get
    public function _getDateCreation($attribute) {
        return $attribute;
    }
}