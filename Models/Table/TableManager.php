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
    public function addClient($nom, $adresse, $image)
    {
        $req = 'INSERT INTO client (nomClient, adresseClient, Image) VALUES (?, ?, ?)';
        $statement = $this->getBdd()->prepare($req);
        $statement->execute([$nom, $adresse, $image]);
    }
    public function deleteClient($id)
    {
        $req = 'DELETE FROM client WHERE id = ?';
        $statement = $this->getBdd()->prepare($req);
        $statement->execute([$id]);
    }
    public function getClient($id)
    {
        $req = 'SELECT * FROM client cl WHERE id = ?';
        $statement = $this->getBdd()->prepare($req);
        $statement->execute([$id]);
        $client = $statement->fetch();
        $statement->closeCursor();
        return $client;
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
        $req = 'INSERT INTO commande (client_id) VALUES (?)';
        $statement = $this->getBdd()->prepare($req);
        $statement->execute([$client]);
    }
    public function errorSupprClient($client)
    {
        $req = 'SELECT COUNT(*) FROM commande c, client cl WHERE c.client_id = cl.id';
        $statement = $this->getBdd()->prepare($req);
        $statement->execute();
        $nombre_commandes = $statement->fetch();
        $statement->closeCursor();
        return $nombre_commandes;
    }
    public function getligneCommandes($id)
    {
        $req = 'SELECT a.id AS idarticle, c.numeroCommande, a.designation, a.prixUnitaire, lc.quantite, a.prixUnitaire*lc.quantite AS total
        FROM commande c, article a, client cl , ligneCommande lc 
        WHERE lc.commande_id= c.id AND lc.article_id = a.id AND c.client_id=cl.id AND c.id = ?';
        $statement = $this->getBdd()->prepare($req);
        $statement->execute([$id]);
        $ligneCommandes = $statement->fetchAll();
        $statement->closeCursor();
        return $ligneCommandes;
    }
}