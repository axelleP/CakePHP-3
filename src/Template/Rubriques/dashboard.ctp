<?php
echo $this->Flash->render('success');
echo $this->Flash->render('error');
?>

<table class="table table-bordered mt-2">
<?php
echo $this->Html->tableHeaders(
    ['Nom', 'Descriptif', ''],
    ['class' => 'thead-dark'],
    ['class' => 'text-center']
);
foreach ($rubriques as $rubrique) {
    echo $this->Html->tableCells([[
        $rubrique->nom,
        $rubrique->descriptif,
        array(
            //modifier
            $this->Html->image('btn-edit-20x20.svg', ['alt' => 'Bouton édition', 'title' => 'Modifier', 'class' => 'commonBtn'])
            . '<br/>'
            //supprimer
            . $this->Html->link(
                $this->Html->image('btn-delete-20x20.svg', ['alt' => 'Bouton suppression', 'title' => 'Supprimer', 'class' => 'commonBtn']),
                ['controller' => 'adminRubriques', 'action' => 'delete', '?' => ['id' => $rubrique->id]],
                ['escape' => false, 'confirm' => 'Confirmez-vous la suppression?']
            ),
            ['class' => 'text-center']//centre la colonne des actions
        )
    ]]);
}
?>
</table>