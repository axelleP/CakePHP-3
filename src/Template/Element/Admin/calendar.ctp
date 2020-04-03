<script type="text/javascript">
    jQuery(document).ready(function() {
        $('#<?= $id ?>').datetimepicker({
            format: 'DD/MM/YYYY HH:mm',
            locale: 'fr',
            sideBySide : true,//date et heure à saisir côte à côte
            showClose : true,//bouton fermer dans la toolbar
            toolbarPlacement: "top",//position de la toolbar
    //        debug: true,//permet de débugger en inspectant l'élément
            icons: {
                up: "fa fa-arrow-up",//heure : flèche en haut
                down: "fa fa-arrow-down",//heure : flèche en bas
                previous: "fa fa-chevron-left",//mois : flèche gauche
                next: "fa fa-chevron-right",//mois : flèche droite
                close: 'fa fa-times'//bouton fermer
            }
        });
    });
</script>