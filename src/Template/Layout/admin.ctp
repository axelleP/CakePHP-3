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
<?= $this->element('General/head', ['layout' => 'admin']); ?>
<body>
    <div class="container">
        <div class="mx-5 p-0 overflow-auto border shadow">
            <div class="row">
                <div class="col-3">
                    <nav class="nav flex-column navbar-dark bg-dark h-100">
                        <ul class="navbar-nav text-center m-0 pt-3">
                            <li class="nav-item"><?= $this->Html->link('Articles', '/admin-articles/show-dashboard', ['id' => 'menuArticle', 'class' => 'nav-link']) ?></li>
                            <li class="nav-item"><?= $this->Html->link('Rubriques', '/admin-rubriques/show-dashboard', ['id' => 'menuRubrique', 'class' => 'nav-link']) ?></li>
                            <li class="nav-item"><?= $this->Html->link('Commentaires', '/admin-commentaires/show-dashboard', ['id' => 'menuCommentaire', 'class' => 'nav-link']) ?></li>
                            <br/>
                            <li class="nav-item"><?= $this->Html->link('Retour au site', '/pages/show-home', ['class' => 'nav-link', 'target' => '_blank']) ?></li>
                            <li class="nav-item"><?= $this->Html->link('Se déconnecter', '/users/logout', ['class' => 'nav-link']) ?></li>
                        </ul>
                    </nav>
                </div>

                <div class="col-9 pt-4">
                <?php
                    echo $this->fetch('content');
                    echo $this->element('Utility/back_top');
                ?>
                </div>
            </div>

            <footer id="sticky-footer" class="py-4 bg-dark text-white-50" style="border-top: solid 0.5px black;">
                <div class="text-center">
                    <small>Copyright &copy; CakePHP Training</small>
                </div>
            </footer>
        </div>
    </div>

    <script type="text/javascript">
        $(function() {
            var urlCourante = window.location.pathname;

            $.each($('.nav-link'), function(index) {
                if (urlCourante == $(this).attr("href")) {
                    $(this).attr('class', 'nav-link menuCourant');
                }
            });
        });
    </script>
</body>
</html>