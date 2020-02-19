<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

use App\Model\Entity\Commentaire;
use App\Model\Entity\Rubrique;

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
            'limit' => 3,
            'order' => ['Commentaires.commentaire' => 'asc']
        ]
    ];

    public function showList($conditions = '')
    {
        //récupération des conditions pour la requête article
        $rubrique_id = null;
        $tabConditions = array();
        if (!empty($conditions)) {
            $tabConditions = unserialize($conditions);
        } elseif (!empty($_GET)) {
            if (isset($_GET['conditions'])) {
                $tabConditions = unserialize($_GET['conditions']);
            } else {
                $tabConditions = $_GET;
            }
        } elseif (!empty($_POST)) {
            $tabConditions = $_POST;
        }

        if (isset($tabConditions['rubrique_id']) && !empty($tabConditions['rubrique_id'])) {
            $rubrique_id = $tabConditions['rubrique_id'];
        }

        //articles
        $tabParamsSQL = array('contain' => ['Rubriques']);
        $tabConditionsSQL = array();
        if (isset($tabConditions['keyword'])) {
            $tabConditionsSQL[] = "(titre LIKE '%" . $tabConditions['keyword'] . "%'"
            . " OR Articles.descriptif LIKE '%" . $tabConditions['keyword'] . "%'"
            . " OR contenu LIKE '%" . $tabConditions['keyword'] . "%')";
        }
        if (!empty($rubrique_id)) {
            $tabConditionsSQL[] = 'rubrique_id =' . $rubrique_id;
        }
        $tabParamsSQL['conditions'] = $tabConditionsSQL;
        $query_article = $this->Articles->find('all', $tabParamsSQL);
        $query_article->toArray();//exécute la requête
        $articles = $this->paginate($query_article);

        //rubriques
        $table_rubrique = TableRegistry::getTableLocator()->get('Rubriques');
        $query_rubrique = $table_rubrique->find('all');
        $rubriques = $query_rubrique->toArray();//exécute la requête
        $listeRubriques = array();
        foreach ($rubriques as $rubrique) {
            $listeRubriques[$rubrique->id] = $rubrique->nom;
        }

        $this->set(array(
            'articles' => $articles,
            'listeRubriques' => $listeRubriques,
            'rubrique_id' => $rubrique_id,
            'tabConditions' => $tabConditions
        ));

        $this->render('/Articles/list');
    }

    public function showView($id)
    {
        $article = $this->Articles->get($id);

        $hash = '';
        $tabObjetsCom = array();
        $tabObjetsCom[$id] = new Commentaire();//objet commentaire du form. com. de l'article

        $dataFormCom = $this->request->getData();
        if (!empty($dataFormCom)) {//soumission du formulaire commentaire
            $nomObjetCom = (isset($dataFormCom['commentaire_id'])) ? $id . '_' . $dataFormCom['commentaire_id'] : $id;
            $tabObjetsCom[$nomObjetCom] = $this->createCommentaire($dataFormCom);

            //nouvel objet + remet le formulaire à vide
            if (!$tabObjetsCom[$nomObjetCom]->errors()) {
                $hash = $tabObjetsCom[$nomObjetCom]->article_id . '_' . $tabObjetsCom[$nomObjetCom]->id;
                $tabObjetsCom[$nomObjetCom] = new Commentaire();
                $this->request->data = null;
            }
        }

        //article précédent
        $query_articlePrecedent = $this->Articles->find('all', [
            'conditions' => ['id <' => $id],
            'order' => 'id DESC',
            'limit' => 1
        ]);
        $articlePrecedent = $query_articlePrecedent->first();
        $idArticlePrecedent = (!empty($articlePrecedent)) ? $articlePrecedent->id : null;

        //article suivant
        $query_articleSuivant = $this->Articles->find('all', [
            'conditions' => ['id >' => $id],
            'order' => 'id DESC',
            'limit' => 1
        ]);
        $articleSuivant = $query_articleSuivant->first();
        $idArticleSuivant = (!empty($articleSuivant)) ? $articleSuivant->id : null;

        //commentaires
        $table_commentaire = TableRegistry::getTableLocator()->get('Commentaires');
        $query_commentaires = $table_commentaire->find('all', [
            'conditions' => ['Commentaires.article_id =' => $id, 'Commentaires.commentaire_id IS NULL'],
            'contain' => ['Users', 'Commentaires2', 'Commentaires2.Users'],
            'order' => 'Commentaires.dateCreation DESC'
        ]);
        $query_commentaires->toArray();//exécute la requête
        $commentaires = $this->paginate($query_commentaires);
        foreach ($commentaires as $com) {//entité du form. commentaire de chaque commentaire de l'article
            $nomObjetCom = $com->article_id . '_' . $com->id;
            if (!isset($tabObjetsCom[$nomObjetCom])) {
                $tabObjetsCom[$nomObjetCom] = new Commentaire();
            }
        }

        $this->set([
            'article' => $article,
            'idArticlePrecedent' => $idArticlePrecedent,
            'idArticleSuivant' => $idArticleSuivant,
            'commentaires' => $commentaires,
            'tabObjetsCom' => $tabObjetsCom,
            'hash' => $hash
        ]);

        $this->render('view');
    }

    public function createCommentaire($dataForm) {
        $table_user = TableRegistry::getTableLocator()->get('Users');
        //recherche de l'utilisateur en bdd
        $query_user = $table_user->find('all', [
            'conditions' => ['email =' => $dataForm['email']],
            'limit' => 1
        ]);
        $user = $query_user->first();
        //s'il n'existe pas on le crée
        if (empty($user)) {
            $user = $table_user->newEntity();
            $user->set('username', $dataForm['username']);
            $user->set('email', $dataForm['email']);
            $table_user->save($user);
        }

        //création du commentaire en bdd si l'objet est valide (vérification par newEntity())
        $table_commentaire = TableRegistry::getTableLocator()->get('Commentaires');
        $dataForm['user_id'] = $user->id;
        $dataForm['dateCreation'] = Time::now();
        $commentaire = $table_commentaire->newEntity($dataForm);//affectation des valeurs + check form
        if (!$commentaire->errors()) {
            $table_commentaire->save($commentaire);
        }

        return $commentaire;
    }
}
