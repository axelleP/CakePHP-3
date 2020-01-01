<div class="row d-flex justify-content-center m-0 mb-3">
    <?php
    for ($i = 0; $i < 8; $i++) {
    ?>
        <div class="card text-center m-2" style="width:13rem;">
          <?php echo $this->Html->image('bg-grey-206x60.png', ['alt' => 'Fond gris', 'class' => 'img-thumbnail img-fluid']); ?>
          <div class="card-body p-1">
            <h5 class="card-title mb-0">Card title</h5>
            <p class="card-text p-0 mb-1">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <?= $this->Html->link('Go somewhere', '/articles/view', ['class' => "btn btn-primary mb-1"]) ?>
          </div>
        </div>
    <?php
    }
    ?>
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