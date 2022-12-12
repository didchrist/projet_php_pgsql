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
            ),
            'nom' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'adresse' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'article-index' => FILTER_SANITIZE_NUMBER_INT,
            'client-index' => FILTER_SANITIZE_NUMBER_INT
        ]);
    }

    public function show_table_article()
    {
        $this->getClean();
        $articles = $this->tableManager->getArticles();
        $table = 'article';
        require_once './Views/table.php';
    }
    public function addArticle()
    {
        $this->getClean();
        $form = 'article';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['designation']) and isset($_POST['prixUnitaire'])) {
                $designation = $_POST['designation'];
                $prixUnitaire = $_POST['prixUnitaire'];
                $this->tableManager->addArticle($designation, $prixUnitaire);
                header('Location: article');
            }
        }
        require_once './Views/form_table.php';
    }
    public function removeArticle()
    {
        $this->getClean();
        $article_index = $_POST['article-index'];
        $this->tableManager->deleteArticle($article_index);

        header('Location: article');
    }
    /* public function setArticle()
    {
        $this->getClean();
        $article_index = $_POST['article-index'] ?? '';

        $article = $this->articleManager->getArticle($article_index);
        $title = $article->titre;
        $description = $article->description;
        $option = $article->idcat;
         else {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $option = $_POST['category'] ?? '';
        }

        $this->userManager = new UserManager;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($title) and isset($description) and isset($option) and $article_index === '') {

                $this->articleManager->addArticle($title, $image_chemin, $description, $option, $iduser);
                header('Location: article');
            }

            if (isset($_POST['validate']) and $article_index != '' and isset($title) and isset($description) and isset($option)) {
                $article = $this->articleManager->getArticle($article_index);
                if ($image_chemin !== '') {
                    $imagename = $article->image;
                    unlink($imagename);
                } else {
                    $image_chemin = $article->image;
                }
                $this->articleManager->updateArticle($title, $image_chemin, $description, $option, $article_index);
                header('Location: homepage');
             require_once './Views/form_table.php.php';
    } */
    public function show_table_client()
    {
        $this->getClean();
        $clients = $this->tableManager->getClients();
        $table = 'client';
        require_once './Views/table.php';
    }
    public function addClient()
    {
        $this->getClean();
        $form = 'client';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['nom']) and isset($_POST['adresse'])) {
                $nom = $_POST['nom'];
                $adresse = $_POST['adresse'];
                $this->tableManager->addClient($nom, $adresse);
                header('Location: client');
            }
        }
        require_once './Views/form_table.php';
    }
    public function removeClient()
    {
        $this->getClean();
        $client_index = $_POST['client-index'];
        $this->tableManager->deleteClient($client_index);

        header('Location: client');
    }
    public function show_table_commande()
    {
        $this->getClean();
        $clients = $this->tableManager->getCommandes();
        $table = 'commande';
        require_once './Views/table.php';
    }
    public function addCommande()
    {
        $this->getClean();
        $form = 'commande';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['client'])) {
                $client = $_POST['client'];
                $this->tableManager->addCommande($client);
                header('Location: commande');
            }
        }
        require_once './Views/form_table.php';
    }
}