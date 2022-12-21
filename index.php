<?php

use Controllers\Table\TableController;
use Models\Table\TableManager;

function autoload($class)
{
    require_once "$class.php";
}
spl_autoload_register("autoload");

$tableController = new TableController();


$page = $_GET['page'] ?? '';

ob_start();

if (empty($page)) {
    header('Location: homepage');
} else {
    if ($page === 'article') {
        $tableController->show_table_article();
        $style = './assets/css/table.css';
    } elseif ($page === 'addArticle') {
        $tableController->addArticle();
        $style = './assets/css/form.css';
    } elseif ($page === 'client') {
        $tableController->show_table_client();
        $style = './assets/css/table.css';
    } elseif ($page === 'addClient') {
        $tableController->addClient();
        $style = './assets/css/form.css';
    } elseif ($page === 'commande') {
        $tableController->show_table_commande();
        $style = './assets/css/table.css';
    } elseif ($page === 'addCommande') {
        $tableController->addCommande();
        $style = './assets/css/form.css';
    } elseif ($page === 'supprArticle') {
        $tableController->removeArticle();
        $style = './assets/css/table.css';
    } elseif ($page === 'supprClient') {
        $tableController->removeClient();
        $style = './assets/css/table.css';
    } elseif ($page === 'ligneCommande') {
        $tableController->show_ligneCommandes();
        $style = './assets/css/table.css';
    } elseif ($page === 'chercheCode') {
        $tableController->chercherCodeArticle();
    } elseif ($page === 'addLigneCommande') {
        $tableController->addLigneCommande();
    } elseif ($page === 'homepage') {
        require_once './Views/homepage.php';
    } elseif ($page === 'setArticle') {
        $tableController->setArticle();
    }
}

$content = ob_get_clean();

if ($page === 'chercheCode') {
    require_once './Views/template/template_bis.php';
} elseif($page === 'addLigneCommande') {
    require_once './Views/template/template_bis.php';
} elseif ($page === 'setArticle') {
    require_once './Views/template/template_bis.php';
} else {
    require_once './Views/template/template.php';
}
