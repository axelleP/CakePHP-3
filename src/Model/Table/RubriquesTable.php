<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class RubriquesTable extends Table
{
    public function initialize(array $config)
    {
        $this->hasMany('Articles', [
            'className' => 'Articles',//table Articles
            'foreignKey' => 'rubrique_id'//clé étrangère rubrique_id
        ]);
    }
}