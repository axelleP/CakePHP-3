<table class="table table-bordered">
  <tbody>
    <tr>
        <th class="table-dark">Rubrique</th>
        <td><?= $article->rubrique->nom; ?></td>
    </tr>
    <tr>
        <th class="table-dark">Date création</th>
        <td><?= $article->dateCreation; ?></td>
    </tr>
    <tr>
        <th class="table-dark">Titre</th>
        <td><?= $article->titre; ?></td>
    </tr>
    <tr>
        <th class="table-dark">Descriptif</th>
        <td><?= $article->descriptif; ?></td>
    </tr>
    <tr>
        <th class="table-dark">Contenu</th>
        <td><?= nl2br($article->contenu); ?></td>
    </tr>
  </tbody>
</table>

<?= $this->Html->link('Retour', '/admin-articles/show-dashboard', ['class' => 'btn btn-secondary']) ?>

<script type="text/javascript">
    $(function() {
        $('#menuArticle').attr('class', 'nav-link menuCourant');
    });
</script>