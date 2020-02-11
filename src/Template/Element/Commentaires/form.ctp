<?php
$nomObjetCom = (isset($commentaire_id)) ? $article->id . '_' . $commentaire_id : $article->id;
$idForm = (isset($commentaire_id)) ? 'formComFromCom_' . $nomObjetCom : 'formComFromArt_' . $nomObjetCom;

/* commentaire */
echo $this->Form->create($tabObjetsCom[$nomObjetCom], ['url' => ['action' => 'show-view/' . $article->id, '#' => $idForm], 'templates' => 'form-template']);
echo $this->Form->hidden('article_id', ['value' => $article->id]);
if ($tabObjetsCom[$nomObjetCom]->hasErrors()) {//permet d'afficher le formulaire en erreur
    echo $this->Form->hidden('idFormError', ['value' => $idForm]);
}
if (isset($commentaire_id)) {
    echo $this->Form->hidden('commentaire_id', ['value' => $commentaire_id]);
}
?>
<div class="row m-0">
    <div class="col-lg-6 p-0">
        <?php
        $styleUsername = 'margin-bottom:0;';
        if ($this->Form->isFieldError('username')) {
            $styleUsername .= 'border-color:red;';
        }
        echo $this->Form->control('username', ['id' => false, 'label' => false, 'placeholder' => 'Nom', 'required' => 0, 'style' => $styleUsername]);
        ?>
    </div>
    <div class="col-lg-6">
        <?php
        $styleEmail = 'margin-bottom:0;';
        if ($this->Form->isFieldError('email')) {
            $styleEmail .= 'border-color:red;';
        }
        echo $this->Form->control('email', ['type' => 'email', 'id' => false, 'label' => false, 'placeholder' => 'Email', 'required' => 0, 'style' => $styleEmail]);
        ?>
    </div>
</div>
<?php
$styleCom = 'margin-bottom:0;';
if ($this->Form->isFieldError('commentaire')) {
    $styleCom .= 'border-color:red;';
}
echo $this->Form->control('commentaire', ['type' => 'textarea', 'id' => false, 'label' => false, 'placeholder' => 'Commentaire', 'required' => 0, 'style' => $styleCom]);
if (isset($commentaire_id)) {
    echo $this->Form->button('Répondre');
} else {
    echo $this->Form->button('Ajouter');
}
echo $this->Form->end();
/* fin commentaire */

//s'il y a des erreurs de saisi, on affiche le formulaire commentaire caché correspondant
if ($tabObjetsCom[$nomObjetCom]->hasErrors()) {
?>
    <script type="text/javascript">
        $("#" + $("[name=idFormError]").val()).show();
    </script>
<?php
}