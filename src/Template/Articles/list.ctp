<?php
$this->Breadcrumbs->add('Articles', ['controller' => 'Articles', 'action' => 'showList']);
echo $this->element('utility/breadcrumb');
?>

<?php
echo $this->Form->create('', ['id' => 'formRubrique']);
echo $this->Form->select('rubrique_id', $listeRubriques, [
    'empty' => 'Choisir une rubrique'
    , 'id' => 'rubrique'
    , 'onchange'=>'$("#formRubrique").submit();'
]);
echo $this->Form->end();
?>
<br/><br/>

<div class="row d-flex justify-content-center m-0 mb-3">
    <?php
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