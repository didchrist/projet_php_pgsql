<?php

namespace Models\Table;

use Models\Database;

class TableManager extends Database
{
    public function getArticles()
    {
        $req = 'SELECT * FROM article';
        $statement = $this->getBdd()->prepare($req);
        $statement->execute();
        $articles = $statement->fetchAll();
        $statement->closeCursor();
        return $articles;
    }
    public function updateArticle($designation, $prixUnitaire)
    {
        $req = 'UPDATE article SET designation = ?, prixUnitaire = ?';
        $statement = $this->getBdd()->prepare($req);
        $statement->execute([$designation, $prixUnitaire]);
    }
    public function deleteArticle($id)
    {
        $req = 'DELETE FROM article WHERE id = ?';
        $statement = $this->getBdd()->prepare($req);
        $statement->execute([$id]);
    }
    public function addArticle($designation, $prixUnitaire)
    {
        $req = 'INSERT INTO article (designation, prixUnitaire) VALUES (?, ?)';
        $statement = $this->getBdd()->prepare($req);
        $statement->execute([$designation, $prixUnitaire]);
    }
}