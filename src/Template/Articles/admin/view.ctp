<table class="table table-bordered">
  <tbody>
    <tr>
        <th class="table-dark" colspan="1">Rubrique</th>
        <td colspan="3"><?= $article->rubrique->nom; ?></td>
    </tr>
    <tr>
        <th class="table-dark" colspan="1">Date création</th>
        <td colspan="3"><?= $article->dateCreation; ?></td>
    </tr>
    <tr>
        <th class="table-dark" colspan="1">Titre</th>
        <td colspan="3"><?= $article->titre; ?></td>
    </tr>
    <tr>
        <th class="table-dark" colspan="1">Descriptif</th>
        <td colspan="3"><?= $article->descriptif; ?></td>
    </tr>
    <tr>
        <th class="table-dark" colspan="1">Contenu</th>
        <td colspan="3"><?= nl2br($article->contenu); ?></td>
    </tr>
  </tbody>
</table>

<?= $this->Html->link('Retour', '/admin-articles/show-dashboard', ['class' => 'btn btn-secondary']) ?>

<script type="text/javascript">
    $(function() {
        $('#menuArticle').attr('class', 'nav-link menuCourant');
    });
</script>