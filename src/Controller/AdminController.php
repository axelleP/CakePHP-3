<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

use Cake\ORM\TableRegistry;

class AdminController extends AppController
{

    public function initialize()
    {
        $this->layout = 'admin';
    }

    public function showDashboard()
    {
//        $u = $this->Auth->user();
        $this->render('/Admin/dashboard');
    }

}
