<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CommentairesTable extends Table
{
    public function initialize(array $config)
    {
        $this->belongsTo('Users');
    }

    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty([
            'commentaire' => ['message' => 'Veuillez écrire un commentaire.'],
            'username' => ['message' => 'Veuillez renseigner votre nom.'],
            'email' => ['message' => 'Veuillez renseigner votre email.']
        ], 'Champ obligatoire.');//message d'erreur par défaut
        $validator->email('email', true, 'Email incorrect.');
        $validator->add('username', 'size', array(
            'rule' => array('maxLength', 100),
            'message' => 'Votre nom ne doit pas dépasser 100 caractères.'
        ));
        $validator->add('email', 'size', array(
            'rule' => array('maxLength', 100),
            'message' => 'Votre email ne doit pas dépasser 100 caractères.'
        ));

        return $validator;
    }
}