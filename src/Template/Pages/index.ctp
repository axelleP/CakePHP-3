<?php
echo $this->Html->css([
'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css',
'https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css'
]);
echo $this->Html->script([
    'https://code.jquery.com/jquery-3.4.1.min.js',
    'https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js'
]);
?>

<h1>TEST!</h1>
<button type="button" class="btn btn-primary">Bouton standard</button>
<button type="button" class="btn btn-success">Réussite</button>
<button type="button" class="btn btn-info">Information</button>
<button type="button" class="btn btn-warning">Avertissement</button>
<button type="button" class="btn btn-danger">Danger</button>
<button type="button" class="btn btn-link">Lien</button>

<br/><br/>

<div class="col-lg-3">
  <ul class="list-group">
    <li class="list-group-item list-group-item-success">On a gagné !</li>
    <li class="list-group-item list-group-item-info">Une petite info</li>
    <li class="list-group-item list-group-item-warning">Attention c'est chaud !</li>
    <li class="list-group-item list-group-item-danger">Par là c'est dangereux...</li>
  </ul>
</div>