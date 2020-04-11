<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;

use App\Model\Entity\Rubrique;

class AdminRubriquesController extends AppController
{
    var $components = array('Flash');//permet d'utiliser les flash messages

    public function initialize()
    {
        parent::initialize();
        $this->layout = 'admin';
    }

    public function showDashboard()
    {
        $table_rubrique = TableRegistry::getTableLocator()->get('Rubriques');
        $query_rubrique = $table_rubrique->find('all', ['order' => 'Rubriques.id DESC']);
        $rubriques = $query_rubrique->toArray();//exécute la requête

        $this->set(['rubriques' => $rubriques]);

        $this->render('/Rubriques/admin/dashboard');
    }

    public function showForm($id = '') {
        if (isset($_POST['btnCancel'])) {
            return $this->redirect(['controller' => 'AdminRubriques', 'action' => 'showDashboard']);
        }

        $table_rubrique = TableRegistry::getTableLocator()->get('Rubriques');
        if (empty($id)) {
            $rubrique = new Rubrique();
        } else {
            $rubrique = $table_rubrique->get($id);
        }

        $dataForm = $this->request->getData();
        //soumission formulaire
        if (!empty($dataForm)) {
            //validation et assignation des données
            $table_rubrique->patchEntity($rubrique, $dataForm);

            if (!$rubrique->errors()) {
                $table_rubrique->save($rubrique);
                $this->Flash->success("La rubrique \"$rubrique->nom\" a bien été créée.", ['key' => 'success']);

                return $this->redirect(['controller' => 'AdminRubriques', 'action' => 'showDashboard']);
            }
        }

        $this->set(['rubrique' => $rubrique]);

        $this->render('/Rubriques/admin/form');
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
                $this->Flash->success("La rubrique \"$rubrique->nom\" a bien été supprimée.", ['key' => 'success']);
            } else {
                $this->Flash->error("Une erreur s'est produite lors de la suppression.", ['key' => 'error']);
            }
        }

        return $this->redirect(['controller' => 'AdminRubriques', 'action' => 'showDashboard']);
    }

}
