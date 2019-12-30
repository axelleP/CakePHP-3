<div class="mb-5">
    <div id="carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel" data-slide-to="0" class="active"></li>
            <li data-target="#carousel" data-slide-to="1"></li>
            <li data-target="#carousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <?php echo $this->Html->image('bg-orange.png', ['alt' => 'First slide', 'class' => 'd-block w-100']) ?>
                <div class="carousel-caption d-none d-md-block">
                    <p>Sibi civitates Palaestina nulli Eleutheropolim egregias velut et aevo.</p>
                </div>
            </div>
            <div class="carousel-item">
                <?php echo $this->Html->image('bg-green.png', ['alt' => 'Second slide', 'class' => 'd-block w-100']) ?>
            </div>
            <div class="carousel-item">
                <?php echo $this->Html->image('bg-blue.png', ['alt' => 'Third slide', 'class' => 'd-block w-100']) ?>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<div class="row mb-5">
    <?php echo '<div class="col-lg-auto col-md-auto col-sm-auto">' . $this->Html->image('bg-grey.png', ['alt' => 'Fond gris', 'class' => 'img-thumbnail img-fluid']) . '</div>'; ?>

    <p class="col-lg-8 align-self-center">
    Potentissimorumque omnis crebris lustratae oculos contentionum bellorum dicam cursibus
    cursibus conferri omnis conferri oculos cursibus crebris ponere libenter nec potuisse
    conferri oculos idque sed tuis saepe nec res magnitudine gestas contentionum omnis conferri
    nec sed omnis potentissimorumque victoriis nostrorum dicam tuis posse peragrari terras
    ponere imperatorum idque idque crebris nec.
    </p>
</div>

<h5>Mandatum :</h5>
<p class="mb-5 text-justify">
    Quaestione igitur per multiplices dilatata fortunas cum ambigerentur quaedam, non nulla
    levius actitata constaret, post multorum clades Apollinares ambo pater et filius in exilium
    acti cum ad locum Crateras nomine pervenissent, villam scilicet suam quae ab Antiochia
    vicensimo et quarto disiungitur lapide, ut mandatum est, fractis cruribus occiduntur.
</p>

<div class="d-flex justify-content-center">
    <div class="embed-responsive embed-responsive-21by9 mb-5 w-75">
      <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/kL_-Zd__ZIA" allowfullscreen></iframe>
    </div>
</div>

<table class="table table-hover mb-5">
<?php
echo $this->Html->tableHeaders(
    ['Alios', 'Causa', 'Locum'],
    ['class' => 'thead-dark']
);
echo $this->Html->tableCells([
    ['Filium' , 'Umbratis', 'Velut'],
    ['Passurum', 'Tunica', 'Muros'],
    ['Mandato', 'Rector', 'Latus'],
]);
?>
</table>

<div class="mb-5">
    <u class="h5">Nomine :</u>
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