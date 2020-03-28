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
<?= $this->element('General/head', ['layout' => 'default']); ?>
<body>
    <div class="container">
        <div class="mx-5 p-0 overflow-auto border shadow">
            <nav class="navbar navbar-expand navbar-dark bg-dark">
                <div class="row">
                    <ul class="navbar-nav col-lg-7 align-self-center">
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
                <div id="frameConnection" class="col-lg-3 shadow p-0" style="display:none;">
                    <div id="titleConnection" class="p-2">
                        Connexion
                        <button type="button" class="close2 p-0" aria-label="Close" onclick="js:$('#frameConnection').css('display', 'none');"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="p-4 border">
                        <?php
                            echo $this->Form->create($user, ['url' => ['action' => '#'], 'templates' => 'form-template', 'id' => 'formConnexion']);
                            echo '<div id="all_errors" class="error-message" style="color:red; display:none; text-align:left;"></div>';
                            echo $this->Form->control('username', ['label' => false, 'placeholder' => 'Login', 'required' => 0]);
                            echo '<div id="username_errors" class="error-message" style="color:red; display:none; text-align:left;"></div>';
                            echo $this->Form->control('password', ['label' => false, 'placeholder' => 'Mot de passe', 'required' => 0]);
                            echo '<div id="password_errors" class="error-message" style="color:red; display:none; text-align:left;"></div>';
                            echo $this->Form->button('Se connecter', ['onclick' => 'js:submitFormConnexion();return false;']);
                            echo $this->Form->end();
                        ?>
                    </div>
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
                        <a id="lienConnexion">Administration</a>
                        <br/>Copyright &copy; CakePHP Training
                    </small>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
    //affiche le bloc de connexion
    $("#lienConnexion").click(function() {
        if ($("#frameConnection").is(":hidden")) {
           $("#frameConnection").fadeIn("slow");
        } else {
           $("#frameConnection").css("display", "none");
        }
    });

    /* permet au bloc connexion de suivre le scroll */
    $(function() {
        var $formAdmin   = $("#frameConnection"),
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

    function submitFormConnexion() {
        $.ajax({
            url: '<?= $this->Url->build(['controller' => 'users', 'action' => 'login']); ?>',
            data: $('#formConnexion').serialize(),
            type: 'POST',
            dataType: 'json',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
            },
            success: function(data) {
                if (data.statut == 'success') {
                    window.location.replace('<?= $this->Url->build(['controller' => 'adminArticles', 'action' => 'show-dashboard']); ?>');
                } else {
                    //supprime les erreurs présentes
                    $("[id$=_errors]").css("display", "none");
                    $("#formConnexion .error").remove();

                    var champActuel = '';
                    $.each(data.tabErrors, function(champ) {
                        $.each(this, function(index, error) {
                            if (champActuel != '' && champActuel != champ) {
                                $('.error').last().append('<br/><br/>');//saut de ligne
                            }
                            champActuel = champ;

                            //affiche l'erreur
                            $("#" + champ + "_errors").fadeIn(800);
                            $("#" + champ + "_errors").append('<div class="error">' + error + '</div>');

                            if (champ == 'all') {
                                $('.error').last().append('<br/><br/>');//saut de ligne
                            }
                        });
                    });
                }
            }
        });
    }
</script>
