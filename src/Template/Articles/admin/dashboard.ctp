<?php
//rque : quand on affiche un flash message, il n'est plus dans ce tableau
$tabSessionFlash = $this->Session->read('Flash');

echo $this->Flash->render('success');
echo $this->Flash->render('error');

if (!empty($tabSessionFlash)) {
    echo '</br>';
}

echo $this->Html->link('Ajouter', '/admin-articles/show-form', ['class' => 'btn btn-primary']);

echo '<br/><br/>';

if (count($articles) != 0) {
    ?>
    <table class="tableAdmin table table-bordered mt-2">
        <thead>
        <?php
        //titres
        echo $this->Html->tableHeaders([
                'Rubrique',
                ['Date création' => ['class' => 'text-center']],
                'Titre',
                'Descriptif',
                ['Contenu' => ['class' => 'text-center']],
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
                '<input type="text" id="dateCreation" class="form-control">',
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
        foreach ($articles as $article) {
            echo $this->Html->tableCells([
                $article->rubrique->nom,
                array($article->dateCreation, ['class' => 'text-center']),
                $article->titre,
                $article->descriptif,
                $this->Text->truncate(
                    $article->contenu,
                    30,//longueur maximal
                    ['ellipsis' => ' ...',//texte de fin si dépassement
                    'exact' => true,//ne coupe pas un mot
                    'html' => true]//ne coupe pas une balise
                ),
                array(
                    //visualiser
                    $this->Html->link(
                        $this->Html->image('btn-see-20x20.svg', ['alt' => 'Bouton visualiser', 'title' => 'Regarder', 'class' => 'commonBtn col-12 col-sm-8 col-lg-6']),
                        ['controller' => 'adminArticles', 'action' => "showView/$article->id"],
                        ['escape' => false]
                    )
                    . '<br/>'
                    //modifier
                    . $this->Html->link(
                        $this->Html->image('btn-edit-20x20.svg', ['alt' => 'Bouton édition', 'title' => 'Modifier', 'class' => 'commonBtn col-12 col-sm-8 col-lg-6']),
                        ['controller' => 'adminArticles', 'action' => "showForm/$article->id"],
                        ['escape' => false]
                    )
                    . '<br/>'
                    //supprimer
                    . $this->Html->link(
                        $this->Html->image('btn-delete-20x20.svg', ['alt' => 'Bouton suppression', 'title' => 'Supprimer', 'class' => 'commonBtn col-12 col-sm-8 col-lg-6']),
                        ['controller' => 'adminArticles', 'action' => "delete/$article->id"],
                        ['escape' => false, 'confirm' => "Confirmez-vous la suppression de l'article et de ses commentaires utilisateur?"]
                    ),
                    ['class' => 'text-center']//centre la colonne
                )
            ]);
        }
        ?>
    </table>
<?php
} else {
    echo "Il n'y a aucun article.";
}

//filtres sur le tableau
echo $this->element('Admin/datatables', ['indexColonneAction' => 5]);