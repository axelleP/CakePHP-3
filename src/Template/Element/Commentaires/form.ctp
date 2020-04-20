<?php
$nomObjetCom = (isset($commentaire_id)) ? $article->id . '_' . $commentaire_id : $article->id;
$idForm = (isset($commentaire_id)) ? 'formComFromCom_' . $nomObjetCom : 'formComFromArt_' . $nomObjetCom;

/* commentaire */
echo $this->Form->create($tabObjetsCom[$nomObjetCom], ['url' => ['action' => 'show-view/' . $article->id, '#' => "ancreFormCom_" . $nomObjetCom], 'templates' => 'form-template']);
echo $this->Form->hidden('article_id', ['value' => $article->id]);
if ($tabObjetsCom[$nomObjetCom]->hasErrors()) {//permet d'afficher le formulaire en erreur
    echo $this->Form->hidden('idFormError', ['value' => $idForm]);
}
if (isset($commentaire_id)) {
    echo $this->Form->hidden('commentaire_id', ['value' => $commentaire_id]);
}
?>
<div class="row m-0">
    <div class="col-6 p-0">
        <?= $this->Form->control('username', ['id' => false, 'label' => false, 'placeholder' => 'Nom', 'required' => 0]); ?>
    </div>
    <div class="col-6">
        <?= $this->Form->control('email', ['type' => 'email', 'id' => false, 'label' => false, 'placeholder' => 'Email', 'required' => 0]); ?>
    </div>
</div>
<?php
echo $this->Form->control('commentaire', ['type' => 'textarea', 'id' => false, 'label' => false, 'placeholder' => 'Commentaire', 'required' => 0]);
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