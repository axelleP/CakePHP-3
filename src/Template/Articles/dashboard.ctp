<table class="table table-bordered">
<?php
echo $this->Html->tableHeaders(
    ['Rubrique', 'Date création', 'Titre', 'Descriptif', ''],
    ['class' => 'thead-dark'],
    ['class' => 'text-center']
);
foreach ($articles as $article) {
    echo $this->Html->tableCells([[
        $article->rubrique->nom,
        array($this->Time->format($article->dateCreation), ['class' => 'text-center']),
        $article->titre,
        $article->descriptif,
        array(
            //visualiser
            $this->Html->image('btn-see-20x20.svg',['alt' => 'Bouton visualiser', 'title' => 'Regarder', 'class' => 'commonBtn'])
            . '<br/>'
            //modifier
            . $this->Html->image('btn-edit-20x20.svg', ['alt' => 'Bouton édition', 'title' => 'Modifier', 'class' => 'commonBtn'])
            . '<br/>'
            //supprimer
            . $this->Html->image('btn-delete-20x20.svg', ['alt' => 'Bouton suppression', 'title' => 'Supprimer', 'class' => 'commonBtn']),
            ['class' => 'text-center']//centre la colonne
        )
    ]]);
}
?>
</table>