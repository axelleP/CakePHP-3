Un commentaire de l'utilisateur <?= $commentaire->user->username ?> a été signalé 5 fois :
<div style="border:solid 1px black; padding: 1rem;">"<?= nl2br($commentaire->commentaire) ?>"</div>
<br/><br/>
<a href="http://localhost/CakePHP/articles/show-view/<?= $commentaire->article_id ?>">Aller sur l'article concerné</a>.
