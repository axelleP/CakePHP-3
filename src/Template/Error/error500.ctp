<?php
use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->layout = 'default';

$tabCodesErrors = array(
    500 => "La demande n'a pas abouti en raison d'une situation inattendue rencontrée par le serveur.",
    502 => "Le serveur a reçu une réponse non valide alors qu'il essayait d'exécuter la requête.",
    504 => "Le serveur en amont n'a pas envoyé de requête dans le délai imparti par le serveur.",
);

$codeError = $this->response->statusCode();
$msgError = $message;
if (array_key_exists($codeError, $tabCodesErrors)) {
    $msgError = $tabCodesErrors[$codeError];
}

if (Configure::read('debug')) :
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error500.ctp');

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
<?php if ($error instanceof Error) : ?>
        <strong>Error in: </strong>
        <?= sprintf('%s, line %s', str_replace(ROOT, 'ROOT', $error->getFile()), $error->getLine()) ?>
<?php endif; ?>
<?php
    echo $this->element('auto_table_warning');

    if (extension_loaded('xdebug')) :
        xdebug_print_function_stack();
    endif;

    $this->end();
endif;
?>
<h2><?= __d('cake', "Une erreur interne s'est produite") ?></h2>
<p class="error">
    <strong><?= __d('cake', "Erreur $codeError ") ?>: </strong>
    <?= h($msgError) ?>
</p>
