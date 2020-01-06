<?php
$this->Breadcrumbs->add('Articles', ['controller' => 'Articles', 'action' => 'showList']);
echo $this->element('utility/breadcrumb');
?>

Dropdown AJAX pour choisir la rubrique
<br/><br/>

<div class="row d-flex justify-content-center m-0 mb-3">
    <?php
    foreach ($paginate as $article) {
    ?>
        <div class="card text-center m-2 mx-3" style="width:13rem;">
          <?php echo $this->Html->image('bg-grey-206x60.png', ['alt' => 'Fond gris', 'class' => 'img-thumbnail img-fluid']); ?>
          <div class="card-body p-1">
            <h5 class="card-title mb-0"><?php echo $article->titre; ?></h5>
            <p class="card-text p-0 mb-1"><?php echo $article->descriptif; ?></p>
            <?= $this->Html->link('Consulter', '/articles/show-view/' . $article->id, ['class' => "btn btn-primary mb-1"]) ?>
          </div>
        </div>
    <?php
    }
    ?>
</div>

<div class="d-flex justify-content-center">
    <nav aria-label="pagination">
      <ul class="pagination">
        <?= $this->Paginator->prev('Précédent') ?>
        <?= $this->Paginator->numbers(); ?>
        <?= $this->Paginator->next('Suivant') ?>
      </ul>
    </nav>
</div>