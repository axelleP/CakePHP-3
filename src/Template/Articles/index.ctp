<div class="row d-flex m-0 mb-3">
    <?php
    for ($i = 0; $i < 6; $i++) {
    ?>
        <div class="card text-center m-3" style="width: 18rem;">
          <?php echo $this->Html->image('bg-grey.png', ['alt' => 'Fond gris', 'class' => 'img-thumbnail img-fluid']); ?>
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <?= $this->Html->link('Go somewhere', '/articles/view', ['class' => "btn btn-primary"]) ?>
          </div>
        </div>
    <?php
    }
    ?>
</div>

<div class="row justify-content-center">
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