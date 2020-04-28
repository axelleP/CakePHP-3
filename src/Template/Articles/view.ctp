<?php
use Cake\Routing\Router;
$urlCourante = Router::url(null, true);

//rque : quand on affiche un flash message, il n'est plus dans ce tableau
$tabSessionFlash = $this->Session->read('Flash');

$this->Breadcrumbs->add([
    ['title' => 'Articles', 'url' => ['controller' => 'Articles', 'action' => 'showList']],
    ['title' => $article->titre, 'url' => ['controller' => 'Articles', 'action' => 'showView', $article->id]]
]);

echo $this->Flash->render('success');

if (!empty($tabSessionFlash)) {
    echo '</br>';
}

echo $this->element('Utility/breadcrumb');
?>
<div class="col">
    <div class="text-center mb-5">
        <h1><?= ucfirst($article->titre); ?></h1>
        <?= $article->dateCreation; ?>
    </div>

    <div class="mb-4 text-break"><?= $article->contenu; ?></div>

    <div class="row m-0">
        <a target="_blank" title="Twitter" href="http://twitter.com/share?url=<?= $urlCourante; ?>&amp;text=<?= $article->titre; ?>" class="px-1 col-1">
            <?= $this->Html->image('logo/logo-twitter.jpg', ['alt' => 'CakePHP', 'class' => 'logo_reseauSocial']); ?>
        </a>
        <a target="_blank" title="Facebook" href="http://www.facebook.com/sharer.php?u=<?= $urlCourante; ?>&amp;t=<?= $article->titre; ?>" class="px-1 col-1">
            <?= $this->Html->image('logo/logo-facebook.png', ['alt' => 'CakePHP', 'class' => 'logo_reseauSocial']); ?>
        </a>
    </div>

    <br/>

    <div class="buttonsArticle mb-5">
        <?php
            echo $this->Html->link('Retour aux articles', '/articles/show-list', ['class' => 'btn btn-dark mb-1 mr-1']);
            if (!empty($idArticlePrecedent)) { echo $this->Html->link('Article précédent', '/articles/show-view/' . $idArticlePrecedent, ['class' => 'btn btn-dark mb-1 mr-1']); }
            if (!empty($idArticleSuivant)) { echo $this->Html->link('Article suivant', '/articles/show-view/' . $idArticleSuivant, ['class' => 'btn btn-dark mb-1']); }
        ?>
    </div>

    <div class="border p-2" id="formComFromArt_<?= $article->id ?>">
        <h4>Commentaires</h4>
        <span id="ancreFormCom_<?= $article->id ?>">&nbsp;</span>
        <?= $this->element('Commentaires/form'); ?>
        </br></br>

        <div>
            <?php
            /* commentaires de l'article */
            foreach ($commentaires as $com) {
                $nomObjetCom = $article->id . '_' . $com->id;
            ?>
                <span id="ancreViewCom_<?= $nomObjetCom ?>" class="mb-1"></span>
                <div class="row">
                    <?= $this->element('Commentaires/view', ['com' => $com, 'showLinkRepondre' => true, 'nomObjetCom' => $nomObjetCom]); ?>
                </div>
            <?php
                //vue des commentaires sous un commentaire de l'article
                if (!empty($com->commentaires2)) {
                    foreach ($com->commentaires2 as $com2) {
                        $nomObjetCom2 = $article->id . '_' . $com2->id;
                        ?>
                        <span id="ancreViewCom_<?= $nomObjetCom2 ?>"></span>
                        <div class="row" style="margin-left: 3rem;"><?= $this->element('Commentaires/view', ['com' => $com2, 'showLinkRepondre' => false]); ?></div>
                        <?php
                    }
                }
            ?>
                <!-- formulaire commentaire -->
                <span id="ancreFormCom_<?= $nomObjetCom ?>">&nbsp;</span>
                <div class="row d-flex justify-content-center">
                    <div class="col-sm-8 mb-3" style="display:none;" id="formComFromCom_<?= $nomObjetCom; ?>">
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

    <?php
    //modifie l'ancre de la page
    if (!empty($hash)) {
    ?>
        <script type="text/javascript">
            $(document).ready(function() {
                document.location.hash = 'ancreViewCom_' + "<?= $hash ?>";
            });
        </script>
    <?php
    }
    ?>
</div>

<script type="text/javascript">
    //clic sur le lien Répondre : affiche ou cache le formulaire com.
    function displayFormCom(id) {
        $formComId = "formComFromCom_"+id;

        if ($("#" + $formComId).is(":hidden")) {
            $("#" + $formComId).show("slow");
            document.location.hash = "ancreFormCom_"+id;//positionne la page sur le form.
        } else {
            document.location.hash = "ancreViewCom_"+id;//positionne la page sur le com.
            $("#" + $formComId).hide("slow");
        }

        //cache tous les autres form. com. des coms. de l'article
        $("[id^=formComFromCom_").each(function() {
            if ($(this).attr('id') !== $formComId) {//sauf celui sur lequel on a cliqué
                $(this).hide("slow");
            }
        });
    }
</script>