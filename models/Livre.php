<?php

require_once __DIR__ . '/../config/Database.php';

class Livre
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function findAll(): array
    {
        $sql = 'SELECT l.*, 
                       CONCAT(a.prenom, " ", a.nom) AS auteur_nom,
                       c.libelle AS categorie_libelle
                FROM livres l
                LEFT JOIN auteurs    a ON l.auteur_id    = a.id
                LEFT JOIN categories c ON l.categorie_id = c.id
                ORDER BY l.titre';
        return $this->pdo->query($sql)->fetchAll();
    }

    public function findById(int $id): array|false
    {
        $stmt = $this->pdo->prepare('SELECT * FROM livres WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function create(string $titre, string $isbn, int $annee, int $quantite, int $auteurId, int $categorieId): bool
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO livres (titre, isbn, annee, quantite, auteur_id, categorie_id)
             VALUES (:titre, :isbn, :annee, :quantite, :auteur_id, :categorie_id)'
        );
        return $stmt->execute([
            ':titre'        => $titre,
            ':isbn'         => $isbn,
            ':annee'        => $annee,
            ':quantite'     => $quantite,
            ':auteur_id'    => $auteurId,
            ':categorie_id' => $categorieId,
        ]);
    }

    public function update(int $id, string $titre, string $isbn, int $annee, int $quantite, int $auteurId, int $categorieId): bool
    {
        $stmt = $this->pdo->prepare(
            'UPDATE livres 
             SET titre = :titre, isbn = :isbn, annee = :annee,
                 quantite = :quantite, auteur_id = :auteur_id, categorie_id = :categorie_id
             WHERE id = :id'
        );
        return $stmt->execute([
            ':id'           => $id,
            ':titre'        => $titre,
            ':isbn'         => $isbn,
            ':annee'        => $annee,
            ':quantite'     => $quantite,
            ':auteur_id'    => $auteurId,
            ':categorie_id' => $categorieId,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM livres WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}