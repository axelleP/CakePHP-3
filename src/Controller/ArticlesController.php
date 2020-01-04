<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

class ArticlesController extends AppController
{
    public function showList($isPopulaire = false)
    {
        $this->render('list');
    }

    public function showView()
    {
        $this->render('view');
    }
}
