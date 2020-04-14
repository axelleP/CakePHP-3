<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\Event\Event;//pour la fonction beforeFilter

class UsersController extends AppController
{
    var $components = array('Flash');//permet d'utiliser les flash messages

    //permet aux utilisateurs d'accéder aux pages suivantes sans se connecter
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow('createAdmin');
    }

    //permet d'ajouter un admin avec un mot de passe valide pour le composant Auth
//    public function createAdmin()
//    {
//        $this->autoRender = false;//pas de render
//
//        $user = $this->Users->newEntity();
//        $user->set('role', 'admin');
//        $user->set('username', 'axelle');
//        $user->set('password', 'admin');
//        $user->set('email', 'be.fri@hotmail.fr');
//        $this->Users->save($user);
//    }

    public function login()
    {
        //soumission du formulaire de connexion
        if ($this->request->is('post')) {
            $this->autoRender = false;//pas de render
            $this->response->type('json');//type de réponse de la requête en JSON
            $tabErrors = array();

            $user = $this->Auth->identify();//fonctionne auto. en utilisant les conventions dans la bdd : users : username, password

            if ($user) {
                $statut = 'success';
                $this->Auth->setUser($user);
            } else {
                $statut = 'error';
                $tabErrors['all'][] = "Identifiant et/ou mot de passe incorrect.";
            }

            $json = json_encode(array('statut' => $statut, 'tabErrors' => $tabErrors));
            $this->response->body($json);
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'show-home']);
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function unsubscribe($id) {
        $user = $this->Users->get($id);
        $user->email = '';
        $this->Users->save($user);

        $this->Flash->success("Vous êtes bien désinscrit du site CakePHP Training.", ['key' => 'success']);

        return $this->redirect(['controller' => 'Pages', 'action' => 'show-home']);
    }

}
