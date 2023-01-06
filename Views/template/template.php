<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MVC - PGSQL</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="<?= $style ?? '' ?>">
</head>

<body id="aside">
    <header>
        <div class="header-top">
            <a href="#" class="logo">
                <div class="logo-box">
                    <p>Projet php</p>
                </div>
            </a>
            <div>
                <h1>Menu</h1>
            </div>
            <div></div>
        </div>
        <div class="header-bot">

            <ul>
                <a href="homepage">
                    <li>Accueil</li>
                </a>
                <?php if (isset($_SESSION['user']) and isset($_SESSION['password'])) : ?>
                <a href="article">
                    <li>Article</li>
                </a>
                <a href="client">
                    <li>Client</li>
                </a>
                <a href="commande">
                    <li>Commande</li>
                </a>
                <a href="quitter">
                    <li>Quitter</li>
                </a>
                <?php endif; ?>
            </ul>
        </div>
    </header>
    <section>
        <?php if (isset($_SESSION['user']) and isset($_SESSION['password'])) : ?>
        <div class="show-role">
            <p><?= 'Niveau : ' . ($role ?? 'Personnalisé') ?></p>
            <p><?= $_SESSION['user'] ?></p>
        </div>
        <?php endif; ?>
        <?= $content ?? 'Block' ?>
    </section>
    <footer>
        <p>© 2022 All right Reserved. Projet PHP</p>
    </footer>
</body>

</html>