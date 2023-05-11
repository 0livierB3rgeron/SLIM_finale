<?php

namespace App\Domain\User\Repository;

use PDO;

/**
 * Repository.
 */
class UserRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Ajoute un User
     * 
     * @param array 
     * 
     * @return array 
     */
    public function createUser(array $data): array
    {
        $sql = "INSERT INTO usager (code_usager, password, cle_api)
                VALUES (:code_usager, :password, :cle_api);
        ";
        
        $params = [
            "code_usager" => $data['nomUser'] ?? "",
            "password"=> $data['mdp'] ?? "",
            "cle_api"=> $data['cle'] ?? null,
        ];

        $query = $this->connection->prepare($sql);
        // L'insertion est fait ici
        $query->execute($params);
        // Je récupère le id qui vient d'être créé
        $userId = $this->connection->lastInsertId();

        $result = $this->selectUserById($userId);

        return $result;
    }

    public function selectUserById(int $userId): array
    {
        $sql = "SELECT * FROM usager WHERE id = :id;";
        $params = [
            'id' => $userId
        ];

        $query = $this->connection->prepare($sql);
        $query->execute($params);

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result[0] ?? [];
    }
}
