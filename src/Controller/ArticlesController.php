<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

use Cake\ORM\TableRegistry;

class ArticlesController extends AppController
{
    public $paginate = [
        'Articles' => [
            'fields' => ['Articles.id'],
            'limit' => 1,
            'order' => ['Articles.titre' => 'asc']
        ],
        'Commentaires' => [
            'fields' => ['Commentaires.id'],
            'limit' => 1,
            'order' => ['Commentaires.commentaire' => 'asc']
        ]
    ];

    public function showList($isPopulaire = false)
    {
        $query_article = $this->Articles->find('all');
        $query_article->toArray();//exécute la requête
        $articles = $this->paginate($query_article);
        $this->set(array('articles' => $articles));
        $this->render('list');
    }

    public function showView($id)
    {
        $article = $this->Articles->get($id);

        $table_commentaire = TableRegistry::getTableLocator()->get('Commentaires');
        $query_commentaires = $table_commentaire->find('all', [
            'conditions' => ['article_id =' => $id],
            'contain' => ['Users']
        ]);
        $query_commentaires->toArray();//exécute la requête
        $commentaires = $this->paginate($query_commentaires);

        $query_articlePrecedent = $this->Articles->find('all', [
            'conditions' => ['id <' => $id],
            'order' => 'id DESC',
            'limit' => 1
        ]);
        $articlePrecedent = $query_articlePrecedent->first();
        $idArticlePrecedent = (!empty($articlePrecedent)) ? $articlePrecedent->id : null;

        $query_articleSuivant = $this->Articles->find('all', [
            'conditions' => ['id >' => $id],
            'order' => 'id DESC',
            'limit' => 1
        ]);
        $articleSuivant = $query_articleSuivant->first();
        $idArticleSuivant = (!empty($articleSuivant)) ? $articleSuivant->id : null;

        $this->set([
            'article' => $article,
            'idArticlePrecedent' => $idArticlePrecedent,
            'idArticleSuivant' => $idArticleSuivant,
            'commentaires' => $commentaires
        ]);

        $this->render('view');
    }
}
