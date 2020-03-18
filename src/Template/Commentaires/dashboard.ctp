<table class="table table-bordered">
<?php
echo $this->Html->tableHeaders(
    ['Date création', 'Article', 'Utilisateur', 'Commentaire', ''],
    ['class' => 'thead-dark'],
    ['class' => 'text-center']
);
foreach ($commentaires as $commentaire) {
    echo $this->Html->tableCells([[
        array($this->Time->format($commentaire->dateCreation), ['class' => 'text-center']),
        $commentaire->article->titre,
        $commentaire->user->username . ' - ' . $commentaire->user->email,
        nl2br($commentaire->commentaire),
        array(
            //visualiser
            $this->Html->image('btn-see-20x20.svg',['alt' => 'Bouton visualiser', 'title' => 'Regarder', 'class' => 'commonBtn'])
            . '<br/>'
            //modifier
            . $this->Html->image('btn-edit-20x20.svg', ['alt' => 'Bouton édition', 'title' => 'Modifier', 'class' => 'commonBtn'])
            . '<br/>'
            //supprimer
            . $this->Html->image('btn-delete-20x20.svg', ['alt' => 'Bouton suppression', 'title' => 'Supprimer', 'class' => 'commonBtn']),
            ['class' => 'text-center']//centre la colonne
        )
    ]]);
}
?>
</table>