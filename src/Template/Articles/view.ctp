<?php
use Cake\Routing\Router;
$urlCourante = Router::url(null, true);

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

<div class="row m-0">
    <a target="_blank" title="Twitter" href="http://twitter.com/share?url=<?= $urlCourante; ?>&amp;text=<?= $article->titre; ?>">
        <?= $this->Html->image('logo/logo-twitter.jpg', array('alt' => 'CakePHP', 'class' => 'logo_reseauSocial')); ?>
    </a>
    <a target="_blank" title="Facebook" href="http://www.facebook.com/sharer.php?u=<?= $urlCourante; ?>&amp;t=<?= $article->titre; ?>">
        <?= $this->Html->image('logo/logo-facebook.png', array('alt' => 'CakePHP', 'class' => 'logo_reseauSocial')); ?>
    </a>
    <a target="_blank" title="Google Plus" href="https://plusone.google.com/_/+1/confirm?hl=en&amp;url=<?= $urlCourante; ?>">
        <?= $this->Html->image('logo/logo-google-plus.png', array('alt' => 'CakePHP', 'class' => 'logo_reseauSocial')); ?>
    </a>
</div>

<br/>

<div class="buttonsArticle mb-5">
    <button type="button" class="btn btn-dark mb-1"><?= $this->Html->link('Retour aux articles', '/articles/show-list') ?></button>
    <?php
    if (!empty($idArticlePrecedent)) { ?> <button type="button" class="btn btn-dark mb-1"> <?= $this->Html->link('Article précédent', '/articles/show-view/' . $idArticlePrecedent) ?> </button> <?php }
    if (!empty($idArticleSuivant)) { ?> <button type="button" class="btn btn-dark mb-1"> <?= $this->Html->link('Article suivant', '/articles/show-view/' . $idArticleSuivant) ?> </button> <?php }
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
                    <div class="row" style="margin-left: 4rem!important;"><?= $this->element('Commentaires/view', ['com' => $com2, 'showLinkRepondre' => false]); ?></div>
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