<section class="section-table">
    <?php if ($table === 'article') : ?>
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
            <form action="setArticle" method="POST">
                <button type="submit" class="button-modify">Modifier</button>
                <input type="hidden" name="article-index" value="<?= $article->id ?>">
            </form>
            <form action="supprArticle" method="POST">
                <input type="hidden" name="article-index" value="<?= $article->id ?>">
                <button type="submit" class="button-show">Afficher</button>
                <button type="submit" class="button-delete">Supprimer</button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>

    <?php elseif ($table === 'client') : ?>
    <h2>LISTE CLIENT</h2>
    <div class="button-presentation">
        <a href="addClient">Nouveau client</a>
        <a href="#">Imprimer</a>
    </div>
    <div class="ligne-presentation">
        <div>
            <p>CODE</p>
        </div>
        <div>
            <p>NOM</p>
        </div>
        <div>
            <p>Adresse</p>
        </div>
        <div>
            <p>Téléphone</p>
        </div>
        <div>
            <p>Actions</p>
        </div>
    </div>
    <?php foreach ($clients as $client) : ?>
    <div class="ligne">
        <div>
            <p><?= $client->numeroclient; ?></p>
        </div>
        <div>
            <p><?= $client->nomclient; ?></p>
        </div>
        <div>
            <p><?= $client->adresseclient; ?></p>
        </div>
        <div>
            <p></p>
        </div>
        <div>
            <form action="setClient" method="POST">
                <button type="submit" class="button-modify">Modifier</button>
                <input type="hidden" name="client-index" value="<?= $client->id ?>">
            </form>
            <form action="supprClient" method="POST">
                <input type="hidden" name="client-index" value="<?= $client->id ?>">
                <button type="submit" class="button-show">Afficher</button>
                <button type="submit" class="button-delete">Supprimer</button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>

    <?php elseif ($table === 'commande') : ?>
    <h2>LISTE COMMANDE</h2>
    <div class="button-presentation">
        <a href="addCommande">Nouveau article</a>
        <a href="#">Imprimer</a>
    </div>
    <div class="ligne-presentation">
        <div>
            <p>Numero</p>
        </div>
        <div>
            <p>Date</p>
        </div>
        <div>
            <p>Nom Client</p>
        </div>
        <div>
            <p>Téléphone Client</p>
        </div>
        <div>
            <p>Montant</p>
        </div>
        <div>
            <p>Actions</p>
        </div>
    </div>
    <?php foreach ($commandes as $commande) : ?>
    <div class="ligne">
        <div>
            <p><?= $commande->numerocommande; ?></p>
        </div>
        <div>
            <p><?= $article->datecommande; ?></p>
        </div>
        <div>
            <p><?= $article->nomclient; ?> €</p>
        </div>
        <div>
            <p></p>
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
    <?php endif; ?>
</section>