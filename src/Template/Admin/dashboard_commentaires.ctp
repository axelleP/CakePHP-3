<table class="table table-bordered">
<?php
echo $this->Html->tableHeaders(
    ['Date création', 'Article', 'Utilisateur', 'Commentaire'],
    ['class' => 'thead-dark'],
    ['class' => 'text-center']
);
foreach ($commentaires as $commentaire) {
    echo $this->Html->tableCells([
        [
            array($this->Time->format($commentaire->dateCreation), array('class' => 'text-center')),
            $commentaire->article->titre,
            $commentaire->user->username . ' - ' . $commentaire->user->email,
            nl2br($commentaire->commentaire)
        ],
    ]);
}
?>
</table>