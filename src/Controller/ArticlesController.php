<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

use Cake\ORM\TableRegistry;

use App\Model\Entity\Commentaire;
use App\Model\Entity\Rubrique;

class ArticlesController extends AppController
{
    public $paginate = [
        'Articles' => [
            'fields' => ['Articles.id'],
            'limit' => 2,
            'order' => ['Articles.titre' => 'asc']
        ],
        'Commentaires' => [
            'fields' => ['Commentaires.id'],
            'limit' => 3,
            'order' => ['Commentaires.commentaire' => 'asc']
        ]
    ];

    public function showList($tabConditions = array())
    {
        if (isset($_POST['rubrique_id']) && !empty($_POST['rubrique_id'])) {
            $query_article = $this->Articles->find('all', [
                'conditions' => ['rubrique_id =' => $_POST['rubrique_id']],
                'contain' => ['Rubriques']
            ]);
        } else {
            $query_article = $this->Articles->find('all', ['contain' => ['Rubriques']]);
        }

        $query_article->toArray();//exécute la requête
        $articles = $this->paginate($query_article);

        $table_rubrique = TableRegistry::getTableLocator()->get('Rubriques');
        $query_rubrique = $table_rubrique->find('all');
        $rubriques = $query_rubrique->toArray();//exécute la requête
        $listeRubriques = array();

        foreach ($rubriques as $rubrique) {
            $listeRubriques[$rubrique->id] = $rubrique->nom;
        }

        $this->set(array('articles' => $articles, 'listeRubriques' => $listeRubriques));

        $this->render('/Articles/list');
    }

    public function showView($id)
    {
        $article = $this->Articles->get($id);

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

        $table_commentaire = TableRegistry::getTableLocator()->get('Commentaires');
        $query_commentaires = $table_commentaire->find('all', [
            'conditions' => ['article_id =' => $id],
            'contain' => ['Users']
        ]);
        $query_commentaires->toArray();//exécute la requête
        $commentaires = $this->paginate($query_commentaires);

        $commentaire = new Commentaire();

        $this->set([
            'article' => $article,
            'idArticlePrecedent' => $idArticlePrecedent,
            'idArticleSuivant' => $idArticleSuivant,
            'commentaires' => $commentaires,
            'commentaire' => $commentaire
        ]);

        $this->render('view');
    }
}
