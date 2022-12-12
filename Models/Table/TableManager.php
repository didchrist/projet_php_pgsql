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
    public function getClients()
    {
        $req = 'SELECT * FROM client';
        $statement = $this->getBdd()->prepare($req);
        $statement->execute();
        $clients = $statement->fetchAll();
        $statement->closeCursor();
        return $clients;
    }
    public function addClient($nom, $adresse)
    {
        $req = 'INSERT INTO client (nomClient, adresseClient) VALUES (?, ?)';
        $statement = $this->getBdd()->prepare($req);
        $statement->execute([$nom, $adresse]);
    }
    public function deleteClient($id)
    {
        $req = 'DELETE FROM client WHERE id = ?';
        $statement = $this->getBdd()->prepare($req);
        $statement->execute([$id]);
    }
    public function getCommandes()
    {
        $req = 'SELECT c.*, cl.nomClient FROM commande c, client cl WHERE c.client_id = cl.id';
        $statement = $this->getBdd()->prepare($req);
        $statement->execute();
        $commandes = $statement->fetchAll();
        $statement->closeCursor();
        return $commandes;
    }
    public function addCommande($client)
    {
        $req = 'INSERT INTO commande (cliend_id) VALUES (?)';
        $statement = $this->getBdd()->prepare($req);
        $statement->execute([$client]);
    }
}