<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    public function initialize(array $config)
    {
        $this->hasMany('Commentaires', [
            'className' => 'Commentaires',//table Commentaires
            'foreignKey' => 'user_id',//clé étrangère user_id
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty([
            'username',
            'password'
        ], 'Champ obligatoire.');//message d'erreur par défaut

        return $validator;
    }
}