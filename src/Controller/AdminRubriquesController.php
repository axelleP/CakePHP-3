<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;

class AdminRubriquesController extends AppController
{
    var $components = array('Flash');//permet d'utiliser les flash messages

    public function initialize()
    {
        $this->layout = 'admin';
    }

    public function showDashboard()
    {
        $table_rubrique = TableRegistry::getTableLocator()->get('Rubriques');
        $query_rubrique = $table_rubrique->find('all', ['order' => 'Rubriques.id DESC']);
        $rubriques = $query_rubrique->toArray();//exécute la requête

        $this->set(array('rubriques' => $rubriques));

        $this->render('/Rubriques/dashboard');
    }

    public function showForm($id = '') {
        if (isset($_POST['btnCancel'])) {
            return $this->redirect(['controller' => 'AdminRubriques', 'action' => 'showDashboard']);
        }

        if (empty($id)) {
            $rubrique = new Rubrique();
        } else {
            $table_rubrique = TableRegistry::getTableLocator()->get('Rubriques');
            $rubrique = $table_rubrique->get($id);
        }

        $dataForm = $this->request->getData();
        //soumission formulaire
        if (!empty($dataForm)) {
            //validation et assignation des données
            $table_rubrique->patchEntity($rubrique, $dataForm);

            if (!$rubrique->errors()) {
                $table_rubrique->save($rubrique);
                return $this->redirect(['controller' => 'AdminRubriques', 'action' => 'showDashboard']);
            }
        }

        $this->set(['rubrique' => $rubrique]);

        $this->render('/Rubriques/form');
    }

    public function delete($id)
    {
        $table_rubrique = TableRegistry::getTableLocator()->get('Rubriques');
        $rubrique = $table_rubrique->get($id, array('contain' => 'articles'));

        if (!empty($rubrique->articles)) {
            $this->Flash->error('Suppression impossible : ' . count($rubrique->articles) . ' article(s) rattaché(s) à cette rubrique.', ['key' => 'error']);
        } else {
            $result = $table_rubrique->delete($rubrique);

            if ($result) {
                $this->Flash->success("La rubrique $rubrique->nom a bien été supprimée.", ['key' => 'success']);
            } else {
                $this->Flash->error("Une erreur s'est produite lors de la suppression.", ['key' => 'error']);
            }
        }

        return $this->redirect(['controller' => 'AdminRubriques', 'action' => 'showDashboard']);
    }

}
