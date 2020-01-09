<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class CommentairesTable extends Table
{
    public function initialize(array $config)
    {
        $this->belongsTo('Users');
    }
}