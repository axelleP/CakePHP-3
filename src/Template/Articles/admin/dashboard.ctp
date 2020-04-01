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

if ($articles->count() != 0) {
    echo $this->Paginator->total('Articles') . ' article(s) trouvé(s).';
    ?>
    <table class="table table-bordered mt-2">
    <?php
    echo $this->Html->tableHeaders([
        'Rubrique',
        ['Date création' => ['class' => 'text-center', 'style' => 'width:18.5%']],
        'Titre',
        'Descriptif',
        ['Contenu' => ['class' => 'text-center', 'style' => 'width:25%']],
        ['' => ['style' => 'width:7%']],
        ],
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
                $article->contenu,
                30,//longueur maximal
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

    <?php
    if ($this->Paginator->total('Articles') > 1) {
    ?>
        <div class="d-flex justify-content-center">
            <nav aria-label="pagination">
              <ul class="pagination">
                <?= $this->Paginator->prev('Précédent') ?>
                <?= $this->Paginator->numbers(); ?>
                <?= $this->Paginator->next('Suivant') ?>
              </ul>
            </nav>
        </div>
    <?php
    }
} else {
    echo "Il n'y a aucun article.";
}