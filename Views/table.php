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
        <?php if (isset($error)) : ?>
        <p class="error"><?= $error ?></p>
        <?php endif; ?>
        <a href="#">Imprimer</a>
    </div>
    <div class="ligne-presentation">
        <div>
            <p>Image</p>
        </div>
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
            <img src="<?= $client->image ?>" alt="" width="25%">
        </div>
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
            <form action="supprClient" method="POST" onsubmit="return confirmer()">
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
            <p><?= $commande->datecommande; ?></p>
        </div>
        <div>
            <p><?= $commande->nomclient; ?></p>
        </div>
        <div>
            <p></p>
        </div>
        <div>
            <p></p>
        </div>
        <div>
            <form action="ligneCommande" method="POST">
                <button type="submit" class="button-modify">Modifier</button>
                <button type="submit" class="button-show">Afficher</button>
                <input type="hidden" name="id" value="<?= $commande->id ?>">
            </form>
            <form action="">
                <button type="submit" class="button-delete">Supprimer</button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
    <?php elseif ($table === 'ligneCommande') : ?>
    <div>
        <label for="numero">Numéro : </label>
        <input name="numero" value="<?= $client->numeroclient ?? '' ?>" type="text" readonly>
        <label for="date">Date : </label>
        <input name="date" value="<?= $client->date ?? '' ?>" type="text" readonly>
        <label for="client">Client : </label>
        <input name="client" value="<?= $client->nomclient ?? '' ?>" type="text" readonly>
        <div>
            <p></p>
        </div>
    </div>
    <div class="ligne-presentation">
        <div>
            <p>Code</p>
        </div>
        <div>
            <p>Designation</p>
        </div>
        <div>
            <p>Prix Unitaire</p>
        </div>
        <div>
            <p>Quantite</p>
        </div>
        <div>
            <p>Total</p>
        </div>
    </div>
    <div class="ligne">
        <div>
            <p>Auto-généré</p>
        </div>
        <div>
            <form action="" method="POST">
                <select name="designation">
                    <?php foreach ($articles as $article) : ?>
                    <option value="<?= $article->id ?>" onchange="prixUnitaire(this.value)"><?= $article->designation ?>
                    </option>
                    <?php endforeach; ?>
                </select>
        </div>
        <div>
            <p id="prixunitaire"></p>
        </div>
        <div>
            <input name="quantite" type="number">
        </div>
        <div>
            <button class="button-modify" type="submit">Valider</button>
            </form>
        </div>
    </div>
    <?php foreach ($ligneCommandes as $lignecommande) : ?>
    <div class="ligne">
        <div>
            <p><?= $lignecommande->numeroarticle; ?></p>
        </div>
        <div>
            <p><?= $lignecommande->designation; ?></p>
        </div>
        <div>
            <p><?= $lignecommande->prixunitaire; ?></p>
        </div>
        <div>
            <p><?= $lignecommande->quantite; ?></p>
        </div>
        <div>
            <p><?= $lignecommande->total; ?></p>
        </div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
</section>
<script>
function confirmer() {
    var msg = "Voulez-vous vraiment supprimer ce client ?"
    if (confirm(msg)) {
        location.replace('index.php?page=supprClient');
    } else {
        return false;
    }
}

function prixUnitaire(valeur) {
    var xml = new XMLHttpRequest();
    xml.open('POST', 'index.php?page=ligneCommande');
    xml.onload = () => {
        var data = JSON.parse(request.reponseText);
        document.getElementById("prixunitaire").innerHTML = valeur;
    }
    xml.send();
}
</script>