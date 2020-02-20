<table class="table table-bordered">
<?php
echo $this->Html->tableHeaders(
    ['Rubrique', 'Date création', 'Titre', 'Descriptif'],
    ['class' => 'thead-dark'],
    ['class' => 'text-center']
);
foreach ($articles as $article) {
    echo $this->Html->tableCells([[
        $article->rubrique->nom,
        array($this->Time->format($article->dateCreation), array('class' => 'text-center')),
        $article->titre,
        $article->descriptif
    ]]);
}
?>
</table>