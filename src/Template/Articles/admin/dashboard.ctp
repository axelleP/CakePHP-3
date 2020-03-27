<?php
echo $this->Flash->render('success');
echo $this->Flash->render('error');
?>

<table class="table table-bordered mt-2">
<?php
echo $this->Html->tableHeaders(
    ['Rubrique', 'Date création', 'Titre', 'Descriptif', 'Contenu', ''],
    ['class' => 'thead-dark'],
    ['class' => 'text-center']
);
foreach ($articles as $article) {
    echo $this->Html->tableCells([[
        $article->rubrique->nom,
        array($article->dateCreation, ['class' => 'text-center']),
        $article->titre,
        $article->descriptif,
        $this->Text->truncate(
            nl2br($article->contenu),
            100,//longueur maximal
            ['ellipsis' => ' ...',//texte de fin si dépassement
            'exact' => true,//ne coupe pas un mot
            'html' => true]//ne coupe pas une balise
        ),
        array(
            //visualiser
            $this->Html->link(
                $this->Html->image('btn-see-20x20.svg', ['alt' => 'Bouton visualiser', 'title' => 'Regarder', 'class' => 'commonBtn']),
                ['controller' => 'adminArticles', 'action' => "showView/$article->id"],
                ['escape' => false]
            )
            . '<br/>'
            //modifier
            . $this->Html->link(
                $this->Html->image('btn-edit-20x20.svg', ['alt' => 'Bouton édition', 'title' => 'Modifier', 'class' => 'commonBtn']),
                ['controller' => 'adminArticles', 'action' => "showForm/$article->id"],
                ['escape' => false]
            )
            . '<br/>'
            //supprimer
            . $this->Html->link(
                $this->Html->image('btn-delete-20x20.svg', ['alt' => 'Bouton suppression', 'title' => 'Supprimer', 'class' => 'commonBtn']),
                ['controller' => 'adminArticles', 'action' => "delete/$article->id"],
                ['escape' => false, 'confirm' => "Confirmez-vous la suppression de l'article et de ses commentaires utilisateur?"]
            ),
            ['class' => 'text-center']//centre la colonne
        )
    ]]);
}
?>
</table>