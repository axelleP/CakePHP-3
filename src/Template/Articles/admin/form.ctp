<h1 class="h3">Formulaire Article :</h1>
<?php
echo $this->Form->create($article, ['url' => ['action' => "show-form"], 'templates' => 'form-template']);
//rubrique
echo $this->Form->select('rubrique_id', $tabRubriques, ['id' => false, 'label' => false, 'required' => 0, 'empty' => 'Choisir une rubrique...', 'val' => $article->rubrique_id]);
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
echo '&nbsp;';
if ($article->isNew()) {
    echo $this->Form->button('Ajouter');
} else {
    echo $this->Form->button('Modifier');
}
echo $this->Form->end();
?>

<script type="text/javascript">
    jQuery(document).ready(function() {
        //calendrier
        $('#dateCreation').datetimepicker({
            format: 'DD/MM/YYYY HH:mm',
            locale: 'fr',
            sideBySide : true,//date et heure à saisir côte à côte
            showClose : true,//bouton fermer dans la toolbar
            toolbarPlacement: "top",//position de la toolbar
    //        debug: true,//permet de débugger en inspectant l'élément
            icons: {
                up: "fa fa-arrow-up",//heure : flèche en haut
                down: "fa fa-arrow-down",//heure : flèche en bas
                previous: "fa fa-chevron-left",//mois : flèche gauche
                next: "fa fa-chevron-right",//mois : flèche droite
                close: 'fa fa-times'//bouton fermer
            }
        });

        //éditeur de texte
        CKEDITOR.replace('contenu',{
            customConfig: '/ckeditor_settings/config.js'
        });
        CKEDITOR.editorConfig = function( config ) {
            config.removeButtons = 'Cut,Copy,Paste,Subscript,Superscript,About';
        };

        $('#menuArticle').attr('class', 'nav-link menuCourant');
    });
</script>