<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

use Cake\ORM\TableRegistry;

use App\Model\Entity\Article;
use App\Model\Entity\Rubrique;

class AdminController extends AppController
{

    public function initialize()
    {
        $this->layout = 'admin';
    }

    public function showDashboardArticles()
    {
//        $u = $this->Auth->user();

        $table_article = TableRegistry::getTableLocator()->get('Articles');
        $query_article = $table_article->find('all', ['contain' => ['Rubriques'], 'order' => 'Articles.id DESC']);
        $articles = $query_article->toArray();//exécute la requête

        $this->set(array('articles' => $articles));

        $this->render('dashboard_articles');
    }

    public function showDashboardRubriques()
    {
        $table_rubrique = TableRegistry::getTableLocator()->get('Rubriques');
        $query_rubrique = $table_rubrique->find('all', ['order' => 'Rubriques.id DESC']);
        $rubriques = $query_rubrique->toArray();//exécute la requête

        $this->set(array('rubriques' => $rubriques));

        $this->render('dashboard_rubriques');
    }

    public function showDashboardCommentaires()
    {
        $table_commentaire = TableRegistry::getTableLocator()->get('Commentaires');
        $query_commentaire = $table_commentaire->find('all', ['contain' => ['Articles', 'Users'], 'order' => 'Commentaires.id DESC']);
        $commentaires = $query_commentaire->toArray();//exécute la requête

        $this->set(array('commentaires' => $commentaires));

        $this->render('dashboard_commentaires');
    }

}
