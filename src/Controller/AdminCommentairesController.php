<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;

class AdminCommentairesController extends AppController
{
    var $components = array('Flash');//permet d'utiliser les flash messages

    public function initialize()
    {
        parent::initialize();
        $this->layout = 'admin';
    }

    public function showDashboard()
    {
        $table_commentaire = TableRegistry::getTableLocator()->get('Commentaires');
        $query_commentaire = $table_commentaire->find('all', ['contain' => ['Articles', 'Users'], 'order' => 'Commentaires.id DESC']);
        $commentaires = $query_commentaire->toArray();//exécute la requête

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

    public function showForm($id) {
        if (isset($_POST['btnCancel'])) {
            return $this->redirect(['controller' => 'AdminCommentaires', 'action' => 'showDashboard']);
        }

        $table_com = TableRegistry::getTableLocator()->get('Commentaires');
        $commentaire = $table_com->get($id, ['contain' => ['Users', 'Articles']]);

        //soumission formulaire
        $dataForm = $this->request->getData();
        if (!empty($dataForm)) {
            //validation et assignation des données
            $table_com->patchEntity($commentaire, $dataForm);

            if (!$commentaire->getErrors()) {
                $table_com->save($commentaire);
                $this->Flash->success("Le commentaire a bien été modifié.", ['key' => 'success']);
                return $this->redirect(['controller' => 'AdminCommentaires', 'action' => 'showDashboard']);
            }
        }

        $this->set(['commentaire' => $commentaire]);

        $this->render('/Commentaires/admin/form');
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
