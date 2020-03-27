<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Time;

class ArticlesTable extends Table
{
    public function initialize(array $config)
    {
        $this->hasMany('Commentaires');
        $this->belongsTo('Rubriques');
    }

    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty([
            'rubrique_id' => ['message' => 'Veuillez choisir une rubrique.'],
            'dateCreation' => ['message' => 'Veuillez renseigner une date de création.'],
            'titre' => ['message' => 'Veuillez renseigner un titre.'],
            'descriptif' => ['message' => 'Veuillez renseigner un descriptif.'],
            'contenu' => ['message' => 'Veuillez renseigner un contenu.']
        ], 'Champ obligatoire.');//message d'erreur par défaut
        //Note : c'est un exemple de code non utilisé car le calendrier force la date quand elle est incorrecte
        $validator->add('dateCreation', 'datetime', [
            'rule' => ['datetime', 'dmy'],
            'message' => 'Format Date / Heure invalide.'
        ]);
        $validator->add('titre', 'size', [
            'rule' => ['maxLength', 50],
            'message' => 'Le titre ne doit pas dépasser 50 caractères.'
        ]);
        $validator->add('descriptif', 'size', [
            'rule' => ['maxLength', 150],
            'message' => 'Le descriptif ne doit pas dépasser 150 caractères.'
        ]);

        return $validator;
    }

    public function beforeSave($event, $entity, $options) {
        //remet la date en format sql
        $dateCreation = Time::createFromFormat(
            'd/m/Y H:i',
            $entity->dateCreation,
            'Europe/Paris'
        );
        $entity->dateCreation = $dateCreation->i18nFormat('yyyy-MM-dd HH:mm:ss');
    }
}