<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

use Cake\ORM\TableRegistry;

class UsersController extends AppController
{

    public function login()
    {
        $this->autoRender = false;
        $this->response->type('json');

        $dataForm = $this->request->data;

        $table_user = TableRegistry::getTableLocator()->get('Users');
        $user = $table_user->newEntity($dataForm);

        $tabErrors = array();
        if (!$user->errors()) {
            //recherche de l'utilisateur en bdd
            $query_user = $table_user->find('all', [
                'conditions' => ['username =' => $user->username, 'password =' => $user->password],
                'limit' => 1
            ]);
            $user = $query_user->first();

            //...

            $statut = 'success';
        } else {
            $statut = 'error';
            foreach ($user->getErrors() as $champ => $errors) {
                foreach ($errors as $error) {
                    $tabErrors[$champ][] = $error;
                }
            }
        }

        $json = json_encode(array('statut' => $statut, 'tabErrors' => $tabErrors));
        $this->response->body($json);
    }

}
