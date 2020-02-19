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
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CakePHP Training</title>
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
                    <ul class="navbar-nav col-lg-7 align-self-center">
                        <li class="nav-item"><?= $this->Html->link('Se déconnecter', '/users/logout', ['class' => "nav-link"]) ?></li>
                    </ul>
                </div>
            </nav>

            <?= $this->Flash->render() ?>

            <div class="pt-4 px-5">
            <?php
                echo $this->fetch('content');
                echo $this->element('Utility/back_top');
            ?>
            </div>

            <footer id="sticky-footer" class="py-4 bg-dark text-white-50">
                <div class="text-center">
                    <small>Copyright &copy; CakePHP Training</small>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
