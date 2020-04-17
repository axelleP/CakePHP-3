<div class="col-sm-1">
    <div class="thumbnail">
        <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
    </div>
</div>

<div class="col-sm-5">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong><?= $com->user->username; ?></strong> <span class="text-muted" style="word-wrap: break-word;">Le <?= $com->dateCreation ?></span>
        </div>

        <div class="panel-body" style="word-wrap: break-word;">
            <?= nl2br($com->commentaire); ?>
            <br/>
            <?php
            $txtSignalement = '';
            if (!empty($com->nbSignalement)) {
                $txtSignalement = "($com->nbSignalement)";
            }
            ?>
            <div class="text-right"><?= $this->Html->link("Signaler ce commentaire $txtSignalement", ['controller' => 'commentaires', 'action' => "signaler/$com->id"], ['confirm' => "Confirmez-vous le signalement?"]) ?></div>
        </div>
    </div>
</div>

<?php
if ($showLinkRepondre) {
?>
    <div class="col-sm-1">
        <?= $this->Html->link('Répondre', '#', ['id' => 'linkRepondre_' . $com->id, 'onclick' => "js:displayFormCom('" . $nomObjetCom . "');return false;"]) ?>
    </div>
<?php
}