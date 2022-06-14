<h1 class="h3">Formulaire Article :</h1>
<?php
echo $this->Form->create($article, ['url' => ['action' => "show-form"], 'templates' => 'form-template']);
//rubrique
echo $this->Form->control('rubrique_id', ['type' => 'select', 'options' => $tabRubriques, 'id' => false, 'label' => false, 'required' => 0, 'empty' => 'Choisir une rubrique...', 'val' => $article->rubrique_id]);
//date création
echo $this->Form->control('dateCreation', ['type' => 'text', 'id' => 'dateCreation', 'label' => false, 'placeholder' => 'Date création', 'required' => 0]);
//titre
echo $this->Form->control('titre', ['id' => false, 'label' => false, 'placeholder' => 'Titre', 'required' => 0]);
//descriptif
echo $this->Form->control('descriptif', ['id' => false, 'label' => false, 'placeholder' => 'Descriptif', 'required' => 0]);
//contenu
echo $this->Form->control('contenu', ['label' => false, 'placeholder' => 'Contenu', 'required' => 0]);
//boutons
echo '<button type="submit" name="btnCancel" class="btn btn-secondary">Annuler</button>';
$this->Form->unlockField('btnCancel');
echo '&nbsp;';
if ($article->isNew()) {
    echo $this->Form->button('Ajouter');
} else {
    echo $this->Form->button('Modifier');
}
echo $this->Form->end();

//calendrier
echo $this->element('Admin/calendar', ['id' => 'dateCreation']);

//ckeditor
echo $this->element('Admin/ckeditor', ['name' => 'contenu']);