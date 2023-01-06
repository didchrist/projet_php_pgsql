<?php
session_start();

use Controllers\Table\TableController;
use Controllers\User\UserController;
use Models\Table\TableManager;

function autoload($class)
{
    require_once "$class.php";
}
spl_autoload_register("autoload");

$tableController = new TableController();
$userController = new UserController();


$page = $_GET['page'] ?? '';

ob_start();
if (isset($_SESSION['user']) and isset($_SESSION['password'])) {
    switch ($page) {
        case 'homepage':
            $userController->verifUser();
            $style = './assets/css/homepage.css';
            break;
        case 'article':
            $tableController->show_table_article();
            $style = './assets/css/table.css';
            break;
        case 'addArticle':
            $tableController->addArticle();
            $style = './assets/css/form.css';
            break;
        case 'supprArticle':
            $tableController->removeArticle();
            $style = './assets/css/table.css';
            break;
        case 'client':
            $tableController->show_table_client();
            $style = './assets/css/table.css';
            break;
        case 'addClient':
            $tableController->addClient();
            $style = './assets/css/form.css';
            break;
        case 'supprClient':
            $tableController->removeClient();
            $style = './assets/css/table.css';
            break;
        case 'commande':
            $tableController->show_table_commande();
            $style = './assets/css/table.css';
            break;
        case 'addCommande':
            $tableController->addCommande();
            $style = './assets/css/form.css';
            break;
        case 'ligneCommande':
            $tableController->show_ligneCommandes();
            $style = './assets/css/table.css';
            break;
        case 'addLigneCommande':
            $tableController->addLigneCommande();
            break;
        case 'setArticle':
            $tableController->setArticle();
            break;
        case 'chercheCode':
            $tableController->chercherCodeArticle();
            break;
        case 'addUser':
            $userController->addUser();
            break;
        case 'quitter':
            $userController->disconnect();
            break;
        case  'test':
            $userController->getPermission();
            break;
        default:
            header('Location: homepage');
    }
} else {
    switch ($page) {
        case 'homepage':
            $userController->verifUser();
            $style = './assets/css/homepage.css';
            break;
        default:
            header('Location: homepage');
    }
}





$content = ob_get_clean();

switch ($page) {
    case ($page == 'chercheCode' || $page == 'addLigneCommande' || $page == 'setArticle' || $page == 'addUser'):
        require_once './Views/template/template_bis.php';
        break;
    default:
        require_once './Views/template/template.php';
}
/* if ($page === 'chercheCode') {
    require_once './Views/template/template_bis.php';
} elseif($page === 'addLigneCommande') {
    require_once './Views/template/template_bis.php';
} elseif ($page === 'setArticle') {
    require_once './Views/template/template_bis.php';
} else {
    require_once './Views/template/template.php';
} */