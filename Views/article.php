<section class="section-table">
    <h2>LISTE ARTICLE</h2>
    <div class="button-presentation">
        <a href="addArticle">Nouveau article</a>
        <a href="#">Imprimer</a>
    </div>
    <div class="ligne-presentation">
        <div>
            <p>CODE</p>
        </div>
        <div>
            <p>DESIGNATION</p>
        </div>
        <div>
            <p>PRIX Unitaire</p>
        </div>
        <div>
            <p>Prix Revient</p>
        </div>
        <div>
            <p>Actions</p>
        </div>
    </div>
    <?php foreach ($articles as $article) : ?>
    <div class="ligne">
        <div>
            <p><?= $article->numeroarticle; ?></p>
        </div>
        <div>
            <p><?= $article->designation; ?></p>
        </div>
        <div>
            <p><?= $article->prixunitaire; ?> €</p>
        </div>
        <div>
            <p></p>
        </div>
        <div>
            <form action="" method="POST">
                <button type="submit" class="button-modify">Modifier</button>
                <button type="submit" class="button-show">Afficher</button>
                <button type="submit" class="button-delete">Supprimer</button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
</section>