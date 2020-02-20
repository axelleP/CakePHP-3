<table class="table table-bordered">
<?php
echo $this->Html->tableHeaders(
    ['Nom', 'Descriptif'],
    ['class' => 'thead-dark'],
    ['class' => 'text-center']
);
foreach ($rubriques as $rubrique) {
    echo $this->Html->tableCells([[
        $rubrique->nom,
        $rubrique->descriptif
    ]]);
}
?>
</table>