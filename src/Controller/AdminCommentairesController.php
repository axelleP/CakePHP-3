<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;

class AdminCommentairesController extends AppController
{
    var $components = array('Flash');//permet d'utiliser les flash messages

    public $paginate = [
        'Commentaires' => [
            'fields' => ['Commentaires.id'],
            'limit' => 1,
            'order' => ['Commentaires.dateCreation' => 'desc']
        ],
    ];

    public function initialize()
    {
        $this->layout = 'admin';
    }

    public function showDashboard()
    {
        $table_commentaire = TableRegistry::getTableLocator()->get('Commentaires');
        $query_commentaire = $table_commentaire->find('all', ['contain' => ['Articles', 'Users'], 'order' => 'Commentaires.id DESC']);
        $query_commentaire->toArray();//exécute la requête
        $commentaires = $this->paginate($query_commentaire);

        $this->set(['commentaires' => $commentaires]);

        $this->render('/Commentaires/admin/dashboard');
    }

    public function showView($id)
    {
        $table_commentaire = TableRegistry::getTableLocator()->get('Commentaires');
        $commentaire = $table_commentaire->get($id, ['contain' => ['Articles', 'Users']]);

        $this->set(['commentaire' => $commentaire]);

        $this->render('/Commentaires/admin/view');
    }

    public function delete($id)
    {
        $table_commentaire = TableRegistry::getTableLocator()->get('Commentaires');
        $commentaire = $table_commentaire->get($id);
        $result = $table_commentaire->delete($commentaire);

        if ($result) {
            $this->Flash->success("Le commentaire a bien été supprimé.", ['key' => 'success']);
        } else {
            $this->Flash->error("Une erreur s'est produite lors de la suppression.", ['key' => 'error']);
        }

        return $this->redirect(['controller' => 'AdminCommentaires', 'action' => 'showDashboard']);
    }

}
