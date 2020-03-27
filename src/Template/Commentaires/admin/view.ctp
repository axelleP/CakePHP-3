<table class="table table-bordered">
  <tbody>
    <tr>
        <th colspan="1" class="table-dark">Date création</th>
        <td colspan="3"><?= $commentaire->dateCreation; ?></td>
    </tr>
    <tr>
        <th colspan="1" class="table-dark">Article</th>
        <td colspan="3"><?= $commentaire->article->titre; ?></td>
    </tr>
    <tr>
        <th class="table-dark">Nom</th>
        <td><?= $commentaire->user->username; ?></td>
        <th class="table-dark">Email</th>
        <td><?= $commentaire->user->email; ?></td>
    </tr>
    <tr>
        <th class="table-dark">Commentaire</th>
        <td colspan="3"><?= nl2br($commentaire->commentaire); ?></td>
    </tr>
  </tbody>
</table>

<?= $this->Html->link('Retour', '/admin-commentaires/show-dashboard', ['class' => 'btn btn-secondary']) ?>

<script type="text/javascript">
    $(function() {
        $('#menuCommentaire').attr('class', 'nav-link menuCourant');
    });
</script>