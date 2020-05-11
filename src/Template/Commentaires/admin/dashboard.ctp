<?php
//rque : quand on affiche un flash message, il n'est plus dans ce tableau
$tabSessionFlash = $this->Session->read('Flash');

echo $this->Flash->render('success');
echo $this->Flash->render('error');

if (!empty($tabSessionFlash)) {
    echo '</br><br/>';
}

if (count($commentaires) != 0) {
    ?>
    <table class="tableAdmin table table-bordered mt-2">
        <thead>
        <?php
        //titres
        echo $this->Html->tableHeaders([
                ['Date création' => ['class' => 'text-center']],
                'Article',
                'Utilisateur',
                'Commentaire',
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
        foreach ($commentaires as $commentaire) {
            echo $this->Html->tableCells([[//rque : double [] car la 1ere entrée est un tableau (=> dateCreation)
                array($commentaire->dateCreation, ['class' => 'text-center']),
                $commentaire->article->titre,
                $commentaire->user->username . ' - ' . $commentaire->user->email,
                $this->Text->truncate(
                    nl2br($commentaire->commentaire),
                    100,//longueur maximal
                    ['ellipsis' => ' ...',//texte de fin si dépassement
                    'exact' => true,//ne coupe pas un mot
                    'html' => true]//ne coupe pas une balise
                ),
                array(
                    //visualiser
                    $this->Html->link(
                        $this->Html->image('btn-see-20x20.svg', ['alt' => 'Bouton visualiser', 'title' => 'Regarder', 'class' => 'commonBtn col-10 col-sm-8 col-md-7 col-lg-5']),
                        ['controller' => 'adminCommentaires', 'action' => "showView/$commentaire->id"],
                        ['escape' => false]
                    )
                    . '<br/>'
                    //modifier
                    . $this->Html->link(
                        $this->Html->image('btn-edit-20x20.svg', ['alt' => 'Bouton édition', 'title' => 'Modifier', 'class' => 'commonBtn col-10 col-sm-8 col-md-7 col-lg-5']),
                        ['controller' => 'adminCommentaires', 'action' => "showForm/$commentaire->id"],
                        ['escape' => false]
                    ),
                    ['class' => 'text-center']//centre la colonne
                )
            ]]);
        }
        ?>
    </table>
<?php
} else {
    echo "Il n'y a aucun commentaire.";
}

//filtres sur le tableau
echo $this->element('Admin/datatables', ['indexColonneAction' => 4]);