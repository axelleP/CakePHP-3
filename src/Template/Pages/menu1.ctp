<h1 class="mb-5 text-center">Titre</h1>

<div class="row mb-5">
<?php
echo '<div><span class="col-md-auto">' . $this->Html->image('grey.png', ['alt' => 'Fond gris', 'class' => 'img-thumbnail img-fluid']) . '</span></div>';
?>

<p class="col-lg-9 align-self-center">
Potentissimorumque omnis crebris lustratae oculos contentionum bellorum dicam cursibus
cursibus conferri omnis conferri oculos cursibus crebris ponere libenter nec potuisse
conferri oculos idque sed tuis saepe nec res magnitudine gestas contentionum omnis conferri
nec sed omnis potentissimorumque victoriis nostrorum dicam tuis posse peragrari terras
ponere imperatorum idque idque crebris nec.
</p>
</div>

<hr>

<table class="mb-5 table table-hover">
<?php
echo $this->Html->tableHeaders(
    ['Colonne 1', 'Colonne 2', 'Colonne 3']
    , ['class' => 'thead-dark']
);
echo $this->Html->tableCells([
    ['Filium' , 'Umbratis', 'Velut'],
    ['Passurum', 'Tunica', 'Muros'],
    ['Mandato', 'Rector', 'Latus'],
]);
?>
</table>

<hr>

<div class="mb-5">
<u class="h5">Liste :</u>
<?php
$list = [
    'Sublimes' => [
        'Fruticeta' => [
            'Dumos',
            'Sobrios',
            'Maras',
        ],
        'Diaconus',
        'Confessisque',
    ]
];
echo $this->Html->nestedList($list);
?>
</div>

<hr>

<div id="carouselExampleIndicators" class="carousel slide mb-5" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="https://placeimg.com/1080/500/animals" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>My Caption Title (1st Image)</h5>
                <p>The whole caption will only show up if the screen is at least medium size.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="https://placeimg.com/1080/500/arch" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="https://placeimg.com/1080/500/nature" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="row col-md-1 ml-auto">
    <?php echo $this->Html->image('fleche_haut.png', ['alt' => 'Flèche en haut', 'id' => 'retour', 'style' => 'cursor:pointer;'])?>
</div>

<script>
$(function(){
    $("#retour").click(function(){
        $("html, body").animate({scrollTop: 0},"slow");
    });
});
</script>