<h1 class="h3">Formulaire Rubrique :</h1>
<?php
echo $this->Form->create($rubrique, ['url' => ['action' => "show-form"], 'templates' => 'form-template']);
//nom
$styleNom = '';
if ($this->Form->isFieldError('nom')) {
    $styleNom .= 'border-color:red;';
}
echo $this->Form->control('nom', ['id' => false, 'label' => false, 'placeholder' => 'Nom', 'required' => 0, 'style' => $styleNom]);
//descriptif
$styleDescriptif = '';
if ($this->Form->isFieldError('descriptif')) {
    $styleDescriptif .= 'border-color:red;';
}
echo $this->Form->control('descriptif', ['id' => false, 'label' => false, 'placeholder' => 'Descriptif', 'required' => 0, 'style' => $styleDescriptif]);
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