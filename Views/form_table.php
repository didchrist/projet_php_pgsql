<section class="section-form">
    <?php if ($form === 'article') : ?>
    <div class="h2-div">
        <h2>SAISIE ARTICLE</h2>
    </div>
    <form action="" method="POST">
        <div>
            <label for="designation">Designation : </label>
            <input class="input-strech" name="designation" type="text" required>
        </div>
        <div>
            <label for="prixUnitaire">Prix unitaire : </label>
            <input name="prixUnitaire" type="number" step="0.01" required>
        </div>
        <div class="div-button">
            <a class="false-button" href="article">Retour à la liste</a>
            <button type="submit">Valider</button>
        </div>
    </form>
    <?php elseif ($form === 'client') : ?>
    <div class="h2-div">
        <h2>SAISIE CLIENT</h2>
    </div>
    <form action="" method="POST">
        <div>
            <label for="nom">Nom : </label>
            <input class="input-strech" name="nom" type="text" required>
        </div>
        <div>
            <label for="adresse">Adresse : </label>
            <input name="adresse" class="input-strech" type="text" required>
        </div>
        <div class="div-button">
            <a class="false-button" href="client">Retour à la liste</a>
            <button type="submit">Valider</button>
        </div>
    </form>
    <?php elseif ($form === 'commande') : ?>
    <div class="h2-div">
        <h2>SAISIE COMMANDE</h2>
    </div>
    <form action="" method="POST">
        <div>
            <label for="client">Client : </label>
            <input class="input-strech" name="client" type="text" required>
        </div>
        <div class="div-button">
            <a class="false-button" href="commande">Retour à la liste</a>
            <button type="submit">Valider</button>
        </div>
    </form>
    <?php endif; ?>
</section>