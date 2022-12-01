<section class="section-form">
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
</section>