<?php
$this->Breadcrumbs->add('Mentions légales', ['controller' => 'Pages', 'action' => 'showLegalMentions']);
echo $this->element('Utility/breadcrumb');
?>

<div class="col">
    <h1 class="text-center mb-5">Mentions légales</h1>

    <fieldset>
        <legend>Hébergement</legend>
        Site hébergé par OVH<br/>
        Adresse : 2 rue Kellermann - 59100 Roubaix - France<br/>
        Téléphone : 1007<br/>
        Site internet : <?= $this->Html->link('https://www.ovh.com/', 'https://www.ovh.com/', ['target' => '_blank']) ?>
    </fieldset>

    <br/>

    <fieldset>
        <legend>Propriété intellectuelle</legend>
        Tous les éléments graphiques de ce site comprenant le logo, les images, les textes, les gifs
        et icônes sont la propriété exclusive d'Axelle Palermo.

        <br/>
        Si les droits de l'auteur ne sont pas respectés, des peines peuvent être encourues selon
        l'article L335-2 du code de la propriété intellectuelle.
    </fieldset>

    <br/>

    <fieldset>
        <legend>Liens hypertextes</legend>
        Ce site met à disposition des liens vers d'autres sites internet. Il ne dispose d'aucun moyen
        pour contrôler la disponibilité et le contenu de ceux-ci. Ce site ne peut donc être tenu
        responsable de tout dommages, de quelque nature que ce soit provenant de ces sites externes.
    </fieldset>
</div>