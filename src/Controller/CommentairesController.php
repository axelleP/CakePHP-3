<?php
namespace App\Controller;

use Cake\Mailer\Email;

class CommentairesController extends AppController
{
    var $components = array('Flash');//permet d'utiliser les flash messages

    public function initialize()
    {
        parent::initialize();
    }

    public function signaler($id)
    {
        $commentaire = $this->Commentaires->get($id, ['contain' => 'Users']);
        $commentaire->nbSignalement++;
        $this->Commentaires->save($commentaire);

        //prévient l'administrateur au bout de 5 signalements
        if ($commentaire->nbSignalement == 5) {
            $this->sendEmailSignalement($commentaire);
        }

        $this->Flash->success('Le commentaire a bien été signalé, merci pour votre contribution.', ['key' => 'success']);

        return $this->redirect(['controller' => 'articles', 'action' => 'showView', $commentaire->article_id]);
    }

    public function sendEmailSignalement($commentaire) {
        $configEmail = Email::config('default');

        $email = new Email();
        $email->setEmailFormat('html');
        $email->setTo($configEmail['from']);
        $email->setSubject("CakePHP Training - Signalement d'un commentaire");
        $email->viewVars(['user' => $commentaire->user, 'commentaire' => $commentaire]);
        $email->viewBuilder()->setLayout('default');
        $email->viewBuilder()->setTemplate('signalement_commentaire');
        $email->send();
    }

}
