<div class="text-right">
    <?php echo $this->Html->image('fleche-haut.png', ['alt' => 'Flèche en haut', 'id' => 'btn-retour', 'class' => 'btn1'])?>
</div>

<script>
$(function(){
    $("#btn-retour").click(function(){
        $("html, body").animate({scrollTop: 0},"slow");
    });
});
</script>