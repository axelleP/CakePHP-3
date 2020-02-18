<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty([
            'username',
            'password'
        ], 'Champ obligatoire.');//message d'erreur par défaut

        return $validator;
    }
}