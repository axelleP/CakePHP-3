<div class="text-right my-3">
    <?php echo $this->Html->image('fleche-haut.png', [
        'alt' => 'Flèche en haut', 'id' => 'btn-retour', 'class' => 'commonBtn col-2 col-sm-2 col-md-2 col-lg-1'
    ])?>
</div>

<script>
$(function(){
    $("#btn-retour").click(function(){
        $("html, body").animate({scrollTop: 0},"slow");
    });
});
</script>