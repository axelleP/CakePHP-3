<div class="text-right mt-3">
    <?php echo $this->Html->image('fleche-haut.png', ['alt' => 'Flèche en haut', 'id' => 'btn-retour', 'class' => 'commonBtn'])?>
</div>

<script>
$(function(){
    $("#btn-retour").click(function(){
        $("html, body").animate({scrollTop: 0},"slow");
    });
});
</script> 