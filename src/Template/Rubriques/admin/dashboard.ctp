<?php
//rque : quand on affiche un flash message, il n'est plus dans ce tableau
$tabSessionFlash = $this->Session->read('Flash');

echo $this->Flash->render('success');
echo $this->Flash->render('error');

if (!empty($tabSessionFlash)) {
    echo '</br>';
}

echo $this->Html->link('Ajouter', '/admin-rubriques/show-form', ['class' => 'btn btn-primary']);

echo '<br/><br/>';

if (count($rubriques) != 0) {
    ?>
    <table class="tableAdmin table table-bordered mt-2">
        <thead>
        <?php
        //titres
        echo $this->Html->tableHeaders([
                'Nom',
                'Descriptif',
                ''
            ],
            ['class' => 'thead-dark'],
            ['class' => 'text-center']
        );
        ?>
        </thead>

        <tfoot>
        <?php
        //filtres
        echo $this->Html->tableHeaders([
                '<input type="text" class="form-control">',
                '<input type="text" class="form-control">',
                ''
            ]
            , ['class' => 'filters']
        );
        ?>
        </tfoot>

        <?php
        //données
        foreach ($rubriques as $rubrique) {
            echo $this->Html->tableCells([
                $rubrique->nom,
                $this->Text->truncate(
                    $rubrique->descriptif,
                    30,//longueur maximal
                    ['ellipsis' => ' ...',//texte de fin si dépassement
                    'exact' => true,//ne coupe pas un mot
                    'html' => true]//ne coupe pas une balise
                ),
                array(
                    //modifier
                    $this->Html->link(
                        $this->Html->image('btn-edit-20x20.svg', ['alt' => 'Bouton édition', 'title' => 'Modifier', 'class' => 'commonBtn col-6 col-xs-4 col-sm-4 col-md-4 col-lg-3']),
                        ['controller' => 'adminRubriques', 'action' => "showForm/$rubrique->id"],
                        ['escape' => false]
                    )
                    . '<br/>'
                    //supprimer
                    . $this->Html->link(
                        $this->Html->image('btn-delete-20x20.svg', ['alt' => 'Bouton suppression', 'title' => 'Supprimer', 'class' => 'commonBtn col-6 col-xs-4 col-sm-4 col-md-4 col-lg-3']),
                        ['controller' => 'adminRubriques', 'action' => "delete/$rubrique->id"],
                        ['escape' => false, 'confirm' => 'Confirmez-vous la suppression?']
                    ),
                    ['class' => 'text-center']//centre la colonne des actions
                )
            ]);
        }
        ?>
    </table>
<?php
} else {
    echo "Il n'y a aucune rubrique.";
}

//filtres sur le tableau
echo $this->element('Admin/datatables', ['indexColonneAction' => 2]);