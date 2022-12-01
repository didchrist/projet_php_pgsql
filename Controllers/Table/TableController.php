<?php

namespace Controllers\Table;

use Models\Table\TableManager;

class TableController
{
    private $tableManager;

    public function __construct()
    {
        $this->tableManager = new TableManager;
    }
    public function getClean()
    {
        $_POST = filter_input_array(INPUT_POST, [
            'designation' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'prixUnitaire' => array(
                'filter' => FILTER_SANITIZE_NUMBER_FLOAT,
                'flags' => FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND
            )
        ]);
    }

    public function show_table_article()
    {
        $this->getClean();
        $articles = $this->tableManager->getArticles();
        require_once './Views/article.php';
    }
    public function addArticle()
    {
        $this->getClean();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['designation']) and isset($_POST['prixUnitaire'])) {
                $designation = $_POST['designation'];
                $prixUnitaire = $_POST['prixUnitaire'];
                print_r($prixUnitaire);
                $this->tableManager->addArticle($designation, $prixUnitaire);
                header('Location: article');
            }
        }
        require_once './Views/addArticle.php';
    }
}