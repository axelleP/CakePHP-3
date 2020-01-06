<?php
$this->Breadcrumbs->add([
    ['title' => 'Articles', 'url' => ['controller' => 'Articles', 'action' => 'showList']],
    ['title' => $article->titre, 'url' => ['controller' => 'Articles', 'action' => 'showView', $article->id]]
]);
echo $this->element('utility/breadcrumb');
?>

<h1 class="text-center mb-5"><?php echo ucfirst($article->titre); ?></h1>

<div class="mb-5"><?php echo nl2br($article->contenu); ?></div>

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
    <form class="mb-5">
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Ajouter un commentaire</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
      </div>
    </form>

    <div class="container">
        <div class="row">
            <div class="col-sm-1">
                <div class="thumbnail">
                <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                </div>
            </div>

            <div class="col-sm-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>myusername</strong> <span class="text-muted">commented 5 days ago</span>
                    </div>

                    <div class="panel-body">
                        Panel content
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-1">
                <div class="thumbnail">
                    <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                </div>
            </div>

            <div class="col-sm-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>myusername</strong> <span class="text-muted">commented 5 days ago</span>
                    </div>

                    <div class="panel-body">
                        Panel content
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <nav aria-label="pagination">
          <ul class="pagination">
            <li class="page-item disabled">
              <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédent</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#">Suivant</a>
            </li>
          </ul>
        </nav>
    </div>
</div>
