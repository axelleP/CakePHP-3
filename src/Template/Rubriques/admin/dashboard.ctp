<?php
//rque : quand on affiche un flash message, il n'est plus dans ce tableau
$tabSessionFlash = $this->Session->read('Flash');

echo $this->Flash->render('success');
echo $this->Flash->render('error');

if (!empty($tabSessionFlash)) {
    echo '</br>';
}
?>

<?= $this->Html->link('Ajouter', '/admin-rubriques/show-form', ['class' => 'btn btn-primary']) ?>

<table class="table table-bordered mt-2">
<?php
echo $this->Html->tableHeaders([
    'Nom',
    'Descriptif',
    ['' => ['style' => 'width:7%']],
    ],
    ['class' => 'thead-dark'],
    ['class' => 'text-center']
);
foreach ($rubriques as $rubrique) {
    echo $this->Html->tableCells([[
        $rubrique->nom,
        $rubrique->descriptif,
        array(
            //modifier
            $this->Html->link(
                $this->Html->image('btn-edit-20x20.svg', ['alt' => 'Bouton édition', 'title' => 'Modifier', 'class' => 'commonBtn']),
                ['controller' => 'adminRubriques', 'action' => "showForm/$rubrique->id"],
                ['escape' => false]
            )
            . '<br/>'
            //supprimer
            . $this->Html->link(
                $this->Html->image('btn-delete-20x20.svg', ['alt' => 'Bouton suppression', 'title' => 'Supprimer', 'class' => 'commonBtn']),
                ['controller' => 'adminRubriques', 'action' => "delete/$rubrique->id"],
                ['escape' => false, 'confirm' => 'Confirmez-vous la suppression?']
            ),
            ['class' => 'text-center']//centre la colonne des actions
        )
    ]]);
}
?>
</table>