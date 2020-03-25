<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Commentaire extends Entity
{
    //exemple de get
    public function _getDateCreation($attribute) {
        return $attribute;
    }
}