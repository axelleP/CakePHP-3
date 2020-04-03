<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CommentairesTable extends Table
{
    public function initialize(array $config)
    {
        $this->belongsTo('Articles');
        $this->belongsTo('Users');
        $this->hasMany('Commentaires2', [
            'className' => 'Commentaires',//table Commentaires
            'foreignKey' => 'commentaire_id',//clé étrangère commentaire_id
            'dependent' => true,//suppression des com2. liés au com. quand le com. est supprimé
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty([
            'commentaire' => ['message' => 'Veuillez écrire un commentaire.'],
            'username' => ['message' => 'Veuillez renseigner votre nom.'],
            'email' => ['message' => 'Veuillez renseigner votre email.']
        ], 'Champ obligatoire.');//message d'erreur par défaut
        $validator->add('username', 'size', [
            'rule' => ['maxLength', 100],
            'message' => 'Votre nom ne doit pas dépasser 100 caractères.'
        ]);
        $validator->add('email', [
            'size' => ['rule' => ['maxLength', 100], 'message' => 'Votre email ne doit pas dépasser 100 caractères.']
            , 'validFormat' => ['rule' => 'email', 'message' => 'Email incorrect.']
        ]);

        return $validator;
    }
}