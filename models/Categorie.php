<?php

require_once __DIR__ . '/../config/Database.php';

class Categorie
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function findAll(): array
    {
        return $this->pdo->query('SELECT * FROM categories ORDER BY libelle')->fetchAll();
    }

    public function findById(int $id): mixed
    {
        $stmt = $this->pdo->prepare('SELECT * FROM categories WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function create(string $libelle): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO categories (libelle) VALUES (:libelle)');
        return $stmt->execute([':libelle' => $libelle]);
    }

    public function update(int $id, string $libelle): bool
    {
        $stmt = $this->pdo->prepare('UPDATE categories SET libelle = :libelle WHERE id = :id');
        return $stmt->execute([':id' => $id, ':libelle' => $libelle]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM categories WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}