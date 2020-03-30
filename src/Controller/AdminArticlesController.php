<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;

use App\Model\Entity\Article;

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

        $this->set(['articles' => $articles]);

        $this->render('/Articles/admin/dashboard');
    }

    public function showView($id)
    {
        $table_article = TableRegistry::getTableLocator()->get('Articles');
        $article = $table_article->get($id, ['contain' => ['Rubriques']]);

        $this->set(['article' => $article]);

        $this->render('/Articles/admin/view');
    }

    public function showForm($id = '') {
        if (isset($_POST['btnCancel'])) {
            return $this->redirect(['controller' => 'AdminArticles', 'action' => 'showDashboard']);
        }

        $table_article = TableRegistry::getTableLocator()->get('Articles');
        if (empty($id)) {
            $article = new Article();
        } else {
            $article = $table_article->get($id);
        }

        //récupération de la liste des rubriques
        $table_rubrique = TableRegistry::getTableLocator()->get('Rubriques');
        $query_rubrique = $table_rubrique->find('all', ['order' => 'Rubriques.id DESC']);
        $rubriques = $query_rubrique->toArray();//exécute la requête

        $tabRubriques = array();
        foreach ($rubriques as $rubrique) {
            $tabRubriques[$rubrique->id] = $rubrique->nom;
        }

        //soumission formulaire
        $dataForm = $this->request->getData();
        if (!empty($dataForm)) {
            //validation et assignation des données
            $table_article->patchEntity($article, $dataForm);

            if (!$article->errors()) {
                $table_article->save($article);
                $this->Flash->success("L'article \"$article->titre\" a bien été crée.", ['key' => 'success']);

                return $this->redirect(['controller' => 'AdminArticles', 'action' => 'showDashboard']);
            }
        }

        $this->set(['article' => $article, 'tabRubriques' => $tabRubriques]);

        $this->render('/Articles/admin/form');
    }

    public function delete($id)
    {
        $table_article = TableRegistry::getTableLocator()->get('Articles');
        $article = $table_article->get($id, ['contain' => ['Commentaires' => ['Commentaires2']]]);

        if (!empty($article->commentaires)) {
            $table_commentaire = TableRegistry::getTableLocator()->get('Commentaires');

            foreach ($article->commentaires as $commentaire) {
                //si le commentaire possède un ou plusieurs com.
                if (!empty($commentaire->commentaires2)) {
                    foreach ($commentaire->commentaires2 as $commentaire2) {
                        $table_commentaire->delete($commentaire2);
                    }
                }

                $table_commentaire->delete($commentaire);
            }
        }

        $result = $table_article->delete($article);

        if ($result) {
            $this->Flash->success("L'article \"$article->titre\" et ses commentaires ont bien été supprimés.", ['key' => 'success']);
        } else {
            $this->Flash->error("Une erreur s'est produite lors de la suppression.", ['key' => 'error']);
        }

        return $this->redirect(['controller' => 'AdminArticles', 'action' => 'showDashboard']);
    }

}
