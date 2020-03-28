<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CakePHP Training</title>
    <?= $this->Html->meta('icon', 'img/cake.png') ?>
    <?php
        //Attention à l'ordre des fichiers!
        $tabCSS = [
            'base.css'
            , 'style.css'
            , 'style2.css'
            , 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'
        ];

        if ($layout == 'admin') {
            $tabCSS[] = 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css';
            $tabCSS[] = 'admin.css';
        }

        echo $this->Html->css($tabCSS);

        //Attention à l'ordre des fichiers!
        $tabScript = [
            'https://code.jquery.com/jquery-3.4.1.min.js'
            , 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'
        ];

        if ($layout == 'admin') {
            $tabScript[] = 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js';//bibliothèque pour la gestion des dates
            $tabScript[] = 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js';
            $tabScript[] = 'https://use.fontawesome.com/97e8ddd49a.js';//images gratuites
            $tabScript[] = 'https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js';
        }

        echo $this->Html->script($tabScript);
    ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>