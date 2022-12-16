<section class="section-form">
    <?php if ($form === 'article') : ?>
    <div class="h2-div">
        <h2>SAISIE ARTICLE</h2>
    </div>
    <form action="addArticle" method="POST">
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
    <form action="addClient" method="POST" enctype="multipart/form-data">
        <div class="div-image">
            <img src="" alt="" id="id_img" width="90%">
        </div>
        <?php if (isset($error)) : ?>
        <p class="error"><?= $error ?></p>
        <?php endif; ?>
        <div>
            <label for="image">Photo : </label>
            <input type="file" name="image" id="img" onchange="previewImage(this,'id_img')">
        </div>
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
    <form action="addCommande" method="POST">
        <div>
            <label for="client">Client : </label>
            <select name="client" class="input-strech">
                <?php foreach ($clients as $client) : ?>
                <option value="<?= $client->id ?>"><?= $client->nomclient ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="div-button">
            <a class="false-button" href="commande">Retour à la liste</a>
            <button type="submit">Valider</button>
        </div>
    </form>
    <?php endif; ?>
</section>
<script>
function previewImage(e, id_img) {
    var picture = e.files[0];
    if (picture) {
        var image = document.getElementById(id_img);
        image.src = URL.createObjectURL(picture);
    }
}
</script>