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
    <table id="table" class="table table-bordered mt-2">
        <thead>
        <?php
        //titres
        echo $this->Html->tableHeaders(
            [
                'Nom',
                'Descriptif',
                ['' => ['style' => 'width:7%']],
            ],
            ['class' => 'thead-dark'],
            ['class' => 'text-center']
        );
        ?>
        </thead>

        <tfoot>
        <?php
        //filtres
        echo $this->Html->tableHeaders(
            [
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
            ], ['class' => 'rows'], ['class' => 'rows']);
        }
        ?>
    </table>
<?php
} else {
    echo "Il n'y a aucune rubrique.";
}
?>

<script type="text/javascript">
    $(document).ready(function($) {
        var table = $('#table').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": 2 }//désactive le tri sur la 3eme colonne
            ],
            "lengthMenu": [[1, 10, 25, -1], [1, 10, 25, "Tous"]],//nb de résultats par page
            "language": {
                "lengthMenu": "Nombre de résultats par page : &nbsp; _MENU_",
                "info": "Affichage de _START_ à _END_ sur _TOTAL_ résultat(s)",
                "infoEmpty": "Aucun résultat",
                "infoFiltered": "",
                "aaSorting": [],
                "paginate": {
                    "previous": "<a>Précédent</a>",
                    "next": "Suivant"
                }
            },
            //configure l'emplacement des éléments (+ ajout de div et de class)
            //l: nb/pages, i:info res., t:tableau, p:pagination
            "dom": '<"wrapper"liti<"d-flex justify-content-center mt-4"p>>'
        });

        //applique la recherche
        table.columns().every( function () {
            var that = this;

            $('input', this.footer()).on('keyup', function () {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();//recrée (draw:redessine) le tableau
                }
            } );
        } );
    } );
</script>
