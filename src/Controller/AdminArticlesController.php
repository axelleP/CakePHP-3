<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;

class AdminArticlesController extends AppController
{
    var $components = array('Flash');//permet d'utiliser les flash messages

    public function initialize()
    {
        $this->layout = 'admin';
    }

    public function showDashboard()
    {
//        $u = $this->Auth->user();

        $table_article = TableRegistry::getTableLocator()->get('Articles');
        $query_article = $table_article->find('all', ['contain' => ['Rubriques'], 'order' => 'Articles.id DESC']);
        $articles = $query_article->toArray();//exécute la requête

        $this->set(array('articles' => $articles));

        $this->render('/Articles/dashboard');
    }

    public function delete()
    {
        $id = $_GET['id'];

//        $table_rubrique = TableRegistry::getTableLocator()->get('Rubriques');
//        $rubrique = $table_rubrique->get($id, array('contain' => 'articles'));
//
//        if (!empty($rubrique->articles)) {
//            $this->Flash->error('Suppression impossible : ' . count($rubrique->articles) . ' article(s) rattaché(s) à cette rubrique.', ['key' => 'error']);
//        } else {
//            $result = $table_rubrique->delete($rubrique);
//
//            if ($result) {
//                $this->Flash->success("La rubrique $rubrique->nom a bien été supprimée.", ['key' => 'success']);
//            } else {
//                $this->Flash->error("Une erreur s'est produite lors de la suppression.", ['key' => 'error']);
//            }
//        }

        return $this->redirect(['controller' => 'AdminArticles', 'action' => 'showDashboard']);
    }

}
