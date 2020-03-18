<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;

class UsersController extends AppController
{

    public function login()
    {
        $this->autoRender = false;
        $this->response->type('json');

        $dataForm = $this->request->getData();

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

            if (is_null($user)) {
                $statut = 'error';
                $tabErrors['all'][] = "Identifiant et/ou mot de passe incorrect.";
            } else {
                $statut = 'success';
                $this->Auth->setUser($user);
            }
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

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

}
