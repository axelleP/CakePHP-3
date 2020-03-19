<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class RubriquesTable extends Table
{
    public function initialize(array $config)
    {
        $this->hasMany('Articles', [
            'className' => 'Articles',//table Articles
            'foreignKey' => 'rubrique_id'//clé étrangère rubrique_id
        ]);
    }

    //=> beforeValidate
    public function beforeMarshal($event, $data) {
        $data['nom'] = trim($data['nom']);
        $data['descriptif'] = trim($data['descriptif']);

        return true;
    }

    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty([
            'nom' => ['message' => 'Veuillez renseigner un nom.'],
            'descriptif' => ['message' => 'Veuillez renseigner un descriptif.'],
        ], 'Champ obligatoire.');//message d'erreur par défaut

        return $validator;
    }
}