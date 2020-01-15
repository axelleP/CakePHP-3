<?php
$this->Breadcrumbs->add([
    ['title' => 'Articles', 'url' => ['controller' => 'Articles', 'action' => 'showList']],
    ['title' => $article->titre, 'url' => ['controller' => 'Articles', 'action' => 'showView', $article->id]]
]);
echo $this->element('utility/breadcrumb');
?>

<h1 class="text-center mb-5"><?= ucfirst($article->titre); ?></h1>

<div class="mb-5"><?= nl2br($article->contenu); ?></div>

SYSTEME DE VOTE (bonus : saisie direct d'un com. après avoir voté en popup)
<br/><br/>
Partage sur les réseaux sociaux
<br/><br/>

<div class="btnArticle mb-5">
    <button type="button" class="btn btn-dark mb-1"><?= $this->Html->link('Retour aux articles', '/articles/show-list') ?></button>
    <?php
    if (!empty($idArticlePrecedent)) {
    ?>
        <button type="button" class="btn btn-dark mb-1"><?= $this->Html->link('Article précédent', '/articles/show-view/' . $idArticlePrecedent) ?></button>
    <?php
    }

    if (!empty($idArticleSuivant)) {
    ?>
        <button type="button" class="btn btn-dark mb-1"><?= $this->Html->link('Article suivant', '/articles/show-view/' . $idArticleSuivant) ?></button>
    <?php
    }
    ?>
</div>

<div class="border p-2">
    <h4>Commentaires</h4>
    <?php
        echo $this->Form->create($commentaire, ['url' => ['controller' => 'Commentaires', 'action' => 'create']]);
        echo $this->Form->control('username', ['label' => false, 'placeholder' => 'Nom', 'required' => true]);
        echo $this->Form->control('email', ['type' => 'email', 'label' => false, 'placeholder' => 'Email', 'required' => true]);
        echo $this->Form->control('commentaire', ['label' => false, 'placeholder' => 'Commentaire', 'required' => true]);
        echo $this->Form->button('Ajouter');
        echo $this->Form->end();
    ?>

    <div class="container">
        <?php
            foreach ($commentaires as $commentaire) {
        ?>
            <div class="row">
                <div class="col-sm-1">
                    <div class="thumbnail">
                    <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong><?= $commentaire->user->username; ?></strong> <span class="text-muted">Le <?= $this->Time->format($commentaire->dateCreation) ?></span>
                        </div>

                        <div class="panel-body"><?= nl2br($commentaire->commentaire); ?></div>
                    </div>
                </div>
            </div>
        <?php
            }
        ?>
    </div>

    <?php
    if ($this->Paginator->counter() != '1 of 1') {
    ?>
        <div class="d-flex justify-content-center">
            <nav aria-label="pagination">
              <ul class="pagination">
                <?= $this->Paginator->prev('Précédent') ?>
                <?= $this->Paginator->numbers(); ?>
                <?= $this->Paginator->next('Suivant') ?>
              </ul>
            </nav>
        </div>
    <?php
    }
    ?>
</div>
