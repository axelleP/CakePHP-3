<h1 class="h3">Formulaire Commentaire :</h1>
<?php
echo $this->Form->create($commentaire, ['url' => ['action' => "show-form"], 'templates' => 'form-template']);
//date création
echo $this->Form->control('dateCreation', ['type' => 'text', 'id' => 'dateCreation', 'label' => false, 'placeholder' => 'Date création', 'disabled' => true]);
//article
echo $this->Form->control('article.titre', ['id' => false, 'label' => false, 'placeholder' => 'Article', 'disabled' => true]);
//utilisateur
echo $this->Form->control('user.username', ['id' => false, 'label' => false, 'placeholder' => 'Utilisateur', 'disabled' => true]);
//email
echo $this->Form->control('user.email', ['id' => false, 'label' => false, 'placeholder' => 'Email', 'disabled' => true]);
//commentaire
echo $this->Form->control('commentaire', ['label' => false, 'placeholder' => 'Commentaire', 'required' => 1]);
//boutons
echo '<button type="submit" name="btnCancel" class="btn btn-secondary">Annuler</button>';
$this->Form->unlockField('btnCancel');
echo '&nbsp;';
echo $this->Form->button('Modifier');
echo $this->Form->end();

//calendrier
echo $this->element('Admin/calendar', ['id' => 'dateCreation']);

//ckeditor
echo $this->element('Admin/ckeditor', ['name' => 'commentaire']);