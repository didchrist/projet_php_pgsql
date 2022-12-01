<?php

use Controllers\Table\TableController;

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
    }
}

$content = ob_get_clean();

require_once './Views/template/template.php';