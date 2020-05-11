<script type="text/javascript">
    jQuery(document).ready(function() {
        CKEDITOR.replace(<?= $name ?>,{
            customConfig: '/ckeditor_settings/config.js'
        });
        CKEDITOR.editorConfig = function( config ) {
            config.removeButtons = 'Cut,Copy,Paste,Subscript,Superscript,About';
            config.language = 'fr';
            config.enterMode = CKEDITOR.ENTER_BR;
        };
    });
</script>