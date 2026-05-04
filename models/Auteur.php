<?php

require_once __DIR__ . '/../config/Database.php';

class Auteur
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM auteurs ORDER BY nom, prenom');
        return $stmt->fetchAll();
    }

    public function findById(int $id): mixed
    {
        $stmt = $this->pdo->prepare('SELECT * FROM auteurs WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function create(string $nom, string $prenom, string $nationalite): bool
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO auteurs (nom, prenom, nationalite) VALUES (:nom, :prenom, :nationalite)'
        );
        return $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':nationalite' => $nationalite,
        ]);
    }

    public function update(int $id, string $nom, string $prenom, string $nationalite): bool
    {
        $stmt = $this->pdo->prepare(
            'UPDATE auteurs SET nom = :nom, prenom = :prenom, nationalite = :nationalite WHERE id = :id'
        );
        return $stmt->execute([
            ':id' => $id,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':nationalite' => $nationalite,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM auteurs WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}