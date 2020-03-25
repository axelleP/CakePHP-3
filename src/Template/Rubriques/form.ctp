<h1 class="h3">Formulaire Rubrique :</h1>
<?php
echo $this->Form->create($rubrique, ['url' => ['action' => "show-form"], 'templates' => 'form-template']);
//nom
echo $this->Form->control('nom', ['id' => false, 'label' => false, 'placeholder' => 'Nom', 'required' => 0]);
//descriptif
echo $this->Form->control('descriptif', ['id' => false, 'label' => false, 'placeholder' => 'Descriptif', 'required' => 0]);
//boutons
echo '<button type="submit" name="btnCancel" class="btn btn-secondary">Annuler</button>';
echo '&nbsp;';
if ($rubrique->isNew()) {
    echo $this->Form->button('Ajouter');
} else {
    echo $this->Form->button('Modifier');
}
echo $this->Form->end();
?>

<script type="text/javascript">
    $(function() {
        $('#menuRubrique').attr('class', 'nav-link menuCourant');
    });
</script>