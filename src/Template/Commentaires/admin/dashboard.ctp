<?php
echo $this->Flash->render('success');
echo $this->Flash->render('error');
?>

<table class="table table-bordered mt-2">
<?php
echo $this->Html->tableHeaders(
    ['Date création', 'Article', 'Utilisateur', 'Commentaire', ''],
    ['class' => 'thead-dark'],
    ['class' => 'text-center']
);
foreach ($commentaires as $commentaire) {
    echo $this->Html->tableCells([[
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
                $this->Html->image('btn-see-20x20.svg', ['alt' => 'Bouton visualiser', 'title' => 'Regarder', 'class' => 'commonBtn']),
                ['controller' => 'adminCommentaires', 'action' => "showView/$commentaire->id"],
                ['escape' => false]
            )
            . '<br/>'
            //supprimer
            . $this->Html->link(
                $this->Html->image('btn-delete-20x20.svg', ['alt' => 'Bouton suppression', 'title' => 'Supprimer', 'class' => 'commonBtn']),
                ['controller' => 'adminCommentaires', 'action' => "delete/$commentaire->id"],
                ['escape' => false, 'confirm' => 'Confirmez-vous la suppression?']
            ),
            ['class' => 'text-center']//centre la colonne
        )
    ]]);
}
?>
</table>