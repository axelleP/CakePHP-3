<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CakePHP Training</title>
        <style>
            a{text-decoration: none; color:#007bff;}
            a:hover{text-decoration: underline; color:#0056B3;}
        </style>
    </head>
    <body>
        <div style="background-color: #333333; padding: 4rem 4rem 1rem 4rem;">
            <div style="background-color: white; padding: 2rem;">
                <?php
                //gmail bloque l'image car on est en localhost?
                echo $this->Html->image("cake.png", ['fullBase' => true]);
                ?>
                <h1 style="text-align:center;">CakePHP Training</h1>
                <br/>
                <p>
                    <?= $this->fetch('content'); ?>
                    <br/><br/><br/>
                    <hr>
                    Axelle PALERMO<br/>
                    <a href="<?= URL ?>/pages/show-home">CakePHP Training</a>
                </p>
            </div>

            <br/><br/>
            <?php
            //lien de désinscription
            if (isset($user->role) && $user->role != 'admin') {
            ?>
                <a href="<?= URL ?>/users/unsubscribe/<?= $user->id ?>" style="color:white; font-size:0.9em;">Se désinscrire</a>
            <?php
            } else {
                echo '<br/>';
            }
            ?>
        </div>
    </body>
</html>