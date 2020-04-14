<div style="background-color: #333333; padding: 4rem 4rem 1rem 4rem;">
    <div style="background-color: white; padding: 2rem;">
        <h1 style="text-align:center;">CakePHP Training</h1>
        <br/>
        <p>
            Bonjour <?= $user->username ?>,
            <br/><br/>
            Un nouveau commentaire a été publié sur l'article <a href="http://localhost/CakePHP/articles/show-view/<?= $commentaire->article->id ?>">"<?= $commentaire->article->titre ?>"</a> du blog <a href="http://localhost/CakePHP/pages/show-home">Training CakePHP</a>.
            <br/><br/><br/>
            <hr>
            Axelle PALERMO<br/>
            <a href="http://localhost/CakePHP/pages/show-home">CakePHP Training</a>
        </p>
    </div>
    <br/><br/><br/>
    <a href="http://localhost/CakePHP/users/unsubscribe/<?= $user->id ?>" style="color:white; font-size:0.9em;">Se désinscrire</a>
</div>