<script type="text/javascript">
    $(document).ready(function($) {
        var table = $('.tableAdmin').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": <?= $indexColonneAction ?> }//désactive le tri sur la 3eme colonne
            ],
            "lengthMenu": [[2, 10, 25, -1], [2, 10, 25, "Tous"]],//nb de résultats par page
            "language": {
                "lengthMenu": "Nombre de résultats par page : &nbsp; _MENU_",
                "info": "Affichage de _START_ à _END_ sur _TOTAL_ résultat(s)",
                "infoEmpty": "",
                "zeroRecords": "Aucun résultat trouvé",
                "infoFiltered": "",
                "aaSorting": [],
                "paginate": {
                    "previous": "<a>Précédent</a>",
                    "next": "Suivant"
                }
            },
            //configure l'emplacement des éléments (+ ajout de div et de class)
            //l: nb/pages, i:info res., t:tableau, p:pagination
            "dom": '<"wrapper"liti<"d-flex justify-content-center mt-4"p>>'
        });

        //applique la recherche
        table.columns().every( function () {
            var that = this;

            $('input', this.footer()).on('keyup', function () {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();//recrée (draw:redessine) le tableau
                }
            } );
        } );
    } );
</script>