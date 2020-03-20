<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;

class AdminCommentairesController extends AppController
{
    var $components = array('Flash');//permet d'utiliser les flash messages

    public function initialize()
    {
        $this->layout = 'admin';
    }

    public function showDashboard()
    {
        $table_commentaire = TableRegistry::getTableLocator()->get('Commentaires');
        $query_commentaire = $table_commentaire->find('all', ['contain' => ['Articles', 'Users'], 'order' => 'Commentaires.id DESC']);
        $commentaires = $query_commentaire->toArray();//exécute la requête

        $this->set(array('commentaires' => $commentaires));

        $this->render('/Commentaires/dashboard');
    }

    public function showView($id)
    {
        $table_commentaire = TableRegistry::getTableLocator()->get('Commentaires');
        $commentaire = $table_commentaire->get($id, ['contain' => ['Articles', 'Users']]);

        $this->set(array('commentaire' => $commentaire));

        $this->render('/Commentaires/view');
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
