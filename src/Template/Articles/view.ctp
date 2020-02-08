<?php
$this->Breadcrumbs->add([
    ['title' => 'Articles', 'url' => ['controller' => 'Articles', 'action' => 'showList']],
    ['title' => $article->titre, 'url' => ['controller' => 'Articles', 'action' => 'showView', $article->id]]
]);
echo $this->element('Utility/breadcrumb');
?>

<h1 class="text-center mb-5"><?= ucfirst($article->titre); ?></h1>

<div class="mb-5"><?= nl2br($article->contenu); ?></div>

SYSTEME DE VOTE (bonus : saisie direct d'un com. après avoir voté en popup)
<br/><br/>
Partage sur les réseaux sociaux
<br/><br/>

<div class="buttonsArticle mb-5">
    <button type="button" class="btn btn-dark mb-1"><?= $this->Html->link('Retour aux articles', '/articles/show-list') ?></button>
    <?php
    if (!empty($idArticlePrecedent)) { ?> <button type="button" class="btn btn-dark mb-1"> <?= $this->Html->link('Article précédent', '/articles/show-view/' . $idArticlePrecedent) ?> </button> <?php }
    if (!empty($idArticleSuivant)) { ?> <button type="button" class="btn btn-dark mb-1"> <?= $this->Html->link('Article suivant', '/articles/show-view/' . $idArticleSuivant) ?> </button> <?php }
    ?>
</div>

<div class="border p-2" id="espaceCommentaire">
    <h4>Commentaires</h4>
    <?= $this->element('Commentaires/form'); ?>
    </br>

    <div class="container">
        <?php
        foreach ($commentaires as $com) {
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
                            <strong><?= $com->user->username; ?></strong> <span class="text-muted">Le <?= $this->Time->format($com->dateCreation) ?></span>
                        </div>

                        <div class="panel-body"><?= nl2br($com->commentaire); ?></div>
                    </div>
                </div>

                <div class="col-sm-1">
                    <?= $this->Html->link('Répondre', '#', ['id' => 'linkRepondre_' . $com->id, 'onclick' => "js:displayFormCom(" . $com->id . ");return false;"]) ?>
                </div>
            </div>
        <?php
            if (!empty($com->commentaires2)) {
                foreach ($com->commentaires2 as $com2) {
//                    echo 'ok<br/>';
                }
            }
        ?>

            <div class="row d-flex justify-content-center">
                <div class="col-sm-8" style="display:none;" id="formCom_<?= $com->id; ?>">
                    <?= $this->element('Commentaires/form', ['commentaire_id' => $com->id]); ?>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

    <?php
    if ($this->Paginator->total('Commentaires') > 1) {
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

<script type="text/javascript">
    function displayFormCom(id) {
        $formComId = "formCom_"+id;

        if ($("#" + $formComId).is(":hidden")) {
            $("#" + $formComId).show("slow");
        } else {
            $("#" + $formComId).hide("slow");
        }

        $("[id^=formCom_").each(function() {
            if ($(this).attr('id') !== $formComId) {
                $(this).hide("slow");
            }
        });
    }
</script>
