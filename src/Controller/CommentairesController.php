<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

use App\Model\Entity\Commentaire;

class CommentairesController extends AppController
{
    public function create()
    {
        $data = $this->request->data;
        $idArticle = 5;

        $table_commentaire = TableRegistry::getTableLocator()->get('Commentaires');
        $commentaire = $table_commentaire->newEntity();
        $commentaire->set('article_id', $idArticle);
        $commentaire->set('user_id', 1);
//        $commentaire->set('username', $data['username']);
//        $commentaire->set('email', $data['email']);
        $commentaire->set('commentaire', $data['commentaire']);
        $commentaire->set('dateCreation', Time::now());

        var_dump('ok');exit;

//        $table_commentaire->save($commentaire);

        $this->redirect(['controller' => 'Articles', 'action' => 'show-view', $idArticle]);
    }
}
