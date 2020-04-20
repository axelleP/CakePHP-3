<?php
$this->Breadcrumbs->add('Articles', ['controller' => 'Articles', 'action' => 'showList']);
echo $this->element('Utility/breadcrumb');
?>

<div class="col">
    <?php
    //information sur la recherche
    if ($articles->count() != 0) {
        echo '<div style="font-size:1.1em; text-align:center;">' . $this->Paginator->total('Articles') . ' article(s) trouvé(s)';

        //si l'user a fait une recherche
        if (isset($tabConditions['keyword']) && !empty($tabConditions['keyword'])) {
            echo ' pour la recherche  : "' . $tabConditions['keyword'] . '"';
        }

        echo '.</div>';
    } else {
        echo '<div style="font-size:1.1em; text-align:center; color:red;">Aucun article ne correspond à votre recherche.</div>';
    }

    ?>

    <br/>

    <span style="font-size:1.1em;">Choisir une rubrique :</span>
    <?php
    //formulaire choix rubrique
    echo $this->Form->create('', ['id' => 'formRubrique', 'method' => 'GET']);
    echo $this->Form->hidden('page', ['value' => 1]);//remet la pagination sur la page 1
    if (isset($tabConditions['keyword'])) {
        echo $this->Form->hidden('keyword', ['value' => $tabConditions['keyword']]);
    }
    echo $this->Form->select('rubrique_id', $listeRubriques, [
        'empty' => '-- Choisissez --'
        , 'id' => 'rubrique'
        , 'onchange'=>'$("#formRubrique").submit();'
        , 'value' => $rubrique_id
    ]);
    echo $this->Form->end();
    ?>

    <br/><br/>

    <div class="row d-flex justify-content-center m-0 mb-3">
        <?php
        //articles
        if ($articles->count() != 0) {
            foreach ($articles as $article) {
            ?>
                <div class="card text-center m-2 mx-3" style="width:13rem;">
                  <?php echo $this->Html->image('bg-grey-206x60.png', ['alt' => 'Fond gris', 'class' => 'img-thumbnail img-fluid']); ?>
                  <div class="card-body p-1">
                    <h5 class="card-title mb-0"><?= $article->titre; ?></h5>
                    <span style="color:grey; font-style: italic;">#<?= $article->rubrique->nom; ?></span>
                    <p class="card-text p-0 mb-1"><?= $article->descriptif; ?></p>
                    <?= $this->Html->link('Consulter', '/articles/show-view/' . $article->id, ['class' => "btn btn-primary mb-1"]) ?>
                  </div>
                </div>
            <?php
            }
        }
        ?>
    </div>

    <?php
    //pagination
    if ($this->Paginator->total('Articles') > 1) {
        $this->Paginator->options(array('url' => array('action' => 'show-list', 'conditions' => serialize($tabConditions))));
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