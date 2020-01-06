<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

use Cake\ORM\TableRegistry;
use App\Model\Entity\Article;

class ArticlesController extends AppController
{
    public $paginate = [
        'fields' => ['Articles.id'],
        'limit' => 2,
        'order' => [
            'Articles.titre' => 'asc'
        ]
    ];

    public function showList($isPopulaire = false)
    {
        $tableArticle = TableRegistry::getTableLocator()->get('Articles');
        $queryArticle = $tableArticle->find('all');
        $queryArticle->toArray();//exécute la requête

        $this->set(array('paginate' => $this->paginate($queryArticle)));

        $this->render('list');
    }

    public function showView($id)
    {
        $tableArticle = TableRegistry::getTableLocator()->get('Articles');

        $article = $tableArticle->get($id);

        $query_articlePrecedent = $tableArticle->find('all', [
            'conditions' => ['id <' => $id],
            'order' => 'id',
            'limit' => 1
        ]);
        $articlePrecedent = $query_articlePrecedent->first();
        $idArticlePrecedent = (!empty($articlePrecedent)) ? $articlePrecedent->id : null;

        $query_articleSuivant = $tableArticle->find('all', [
            'conditions' => ['id >' => $id],
            'order' => 'id',
            'limit' => 1
        ]);
        $articleSuivant = $query_articleSuivant->first();
        $idArticleSuivant = (!empty($articleSuivant)) ? $articleSuivant->id : null;

        $this->set(['article' => $article, 'idArticlePrecedent' => $idArticlePrecedent, 'idArticleSuivant' => $idArticleSuivant]);

        $this->render('view');
    }
}
