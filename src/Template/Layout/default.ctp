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
                      <li class="nav-item"><?= $this->Html->link('Accueil', '/pages/accueil', ['class' => "nav-link"]) ?></li>
                      <li class="nav-item"><?= $this->Html->link('Articles', '/articles/index', ['class' => "nav-link"]) ?></li>
                      <li class="nav-item"><?= $this->Html->link('Menu 3', '/pages/menu3', ['class' => "nav-link"]) ?></li>
                    </ul>

                    <form class="form-inline col-lg-4">
                        <input class="form-control my-2 mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </nav>

            <?= $this->Flash->render() ?>

            <div class="p-4">
            <?=
            $this->fetch('content');
            echo $this->element('utility/back_top');
            ?>
            </div>

            <footer class="col-lg-12"></footer>
        </div>
    </div>
</body>
</html>
