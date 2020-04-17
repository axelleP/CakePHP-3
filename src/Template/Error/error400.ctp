<?php
use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->layout = 'default';

$tabCodesErrors = array(
    400 => "La demande ne peut pas être satisfaite en raison d'une mauvaise syntaxe.",
    403 => "Le serveur a refusé de répondre à votre demande.",
    404 => "La page que vous avez demandé n'a pas été trouvée sur ce serveur.",
    405 => "La méthode spécifiée dans la demande n'est pas autorisée pour la ressource spécifiée.",
    408 => "Votre navigateur n'a pas réussi à envoyer une requête dans le temps imparti par le serveur.",
);

$codeError = $this->response->statusCode();
$msgError = 'The requested address {0} was not found on this server.';
if (array_key_exists($codeError, $tabCodesErrors)) {
    $msgError = $tabCodesErrors[$codeError];
}

if (Configure::read('debug')) :
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error400.ctp');

    $this->start('file');
?>
<?php if (!empty($error->queryString)) : ?>
    <p class="notice">
        <strong>SQL Query: </strong>
        <?= h($error->queryString) ?>
    </p>
<?php endif; ?>
<?php if (!empty($error->params)) : ?>
        <strong>SQL Query Params: </strong>
        <?php Debugger::dump($error->params) ?>
<?php endif; ?>
<?= $this->element('auto_table_warning') ?>
<?php
if (extension_loaded('xdebug')) :
    xdebug_print_function_stack();
endif;

$this->end();
endif;
?>
<h2><?= h('Page introuvable') ?></h2>
<p class="error">
    <strong><?= __d('cake', "Erreur $codeError ") ?>: </strong>
    <?= __d('cake', $msgError, "<strong>'{$url}'</strong>") ?>
</p>
