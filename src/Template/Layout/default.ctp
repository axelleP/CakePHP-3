<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?=
        $this->Html->css([
            'base.css'
            , 'style.css'
            , 'style2.css'
            , 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'
        ]);
    ?>

    <?=
        $this->Html->script([
            'https://code.jquery.com/jquery-3.4.1.min.js'
            , 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'
        ]);
    ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div class="container">
        <div class="mx-5 p-0 overflow-auto border shadow">
            <nav class="navbar navbar-expand navbar-dark bg-dark">
                <div class="row">
                    <ul class="navbar-nav col-lg-7">
                      <li class="nav-item"><?= $this->Html->link('Accueil', '/pages/show-home', ['class' => "nav-link"]) ?></li>
                      <li class="nav-item"><?= $this->Html->link('Articles', '/articles/show-list', ['class' => "nav-link"]) ?></li>
                      <li class="nav-item"><?= $this->Html->link('Articles populaires', '/articles/show-list/' . serialize(array('isPopulaire' => true)), ['class' => "nav-link"]) ?></li>
                    </ul>

                    <?php
                        echo $this->Form->create('', ['templates' => 'formSearch-template', 'url' => ['controller' => 'Articles', 'action' => 'show-list']]);
                        echo $this->Form->text('keyword', ['type' => 'search', 'label' => 'Rechercher', 'placeholder' => 'Rechercher']);
                        echo $this->Form->button('Rechercher');
                        echo $this->Form->end();
                    ?>
                </div>
            </nav>

            <?= $this->Flash->render() ?>

            <div class="d-flex justify-content-center">
                <div id="formAdmin" class="col-lg-4 border shadow p-4" style="display:none;">
                <?php
                    echo $this->Form->create($user, ['url' => ['action' => 'login'], 'templates' => 'form-template']);
                    echo $this->Form->control('username', ['label' => false, 'placeholder' => 'Login', 'required' => 0]);
                    echo $this->Form->control('password', ['label' => false, 'placeholder' => 'Mot de passe', 'required' => 0]);
                    echo $this->Form->button('Se connecter');
                    echo $this->Form->end();
                ?>
                </div>
            </div>

            <div class="pt-4 px-5">
            <?php
                echo $this->fetch('content');
                echo $this->element('Utility/back_top');
            ?>
            </div>

            <footer id="sticky-footer" class="py-4 bg-dark text-white-50">
                <div class="text-center">
                    <small>
                        <a id="lienAdmin">Administration</a>
                        <br/>Copyright &copy; CakePHP Training
                    </small>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
    $("#lienAdmin").click(function() {
        if ($("#formAdmin").is(":hidden")) {
           $("#formAdmin").fadeIn("slow");
        } else {
           $("#formAdmin").css("display", "none");
        }
    });

    /* permet au bloc connexion de suivre le scroll */
    $(function() {
        var $formAdmin   = $("#formAdmin"),
            $window    = $(window),//représente une fenêtre ouverte dans un navigateur
            offset     = $formAdmin.offset(),//coordonnées actuelles du formulaire
            topPadding = 50;//permet de positionner le cadre

        //si l'utilisateur a scroll
        $window.scroll(function() {
            //si la position du scroll est > aux coordonnées du form.
            if ($window.scrollTop() > offset.top) {
                $formAdmin.stop().animate({//stoppe les animations en cours puis crée une animation
                    marginTop: $window.scrollTop() - offset.top + topPadding//redéfinit le margin top
                });
            } else {
                $formAdmin.stop().animate({
                    marginTop: 0
                });
            }
        });
    });
</script>
