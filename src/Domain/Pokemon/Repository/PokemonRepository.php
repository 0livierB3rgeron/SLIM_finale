<?php

namespace App\Domain\Pokemon\Repository;

use PDO;

/**
 * Repository.
 */
class PokemonRepository
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
     * Sélectionne la liste de tous les films
     * 
     * @return DataResponse
     */
    public function selectAllPokemon(): array
    {
        $sql = "SELECT * FROM pokemon;";

        $query = $this->connection->prepare($sql);
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Sélectionne les informations d'un film
     * 
     * @param int $movieId Le id du film à afficher
     * 
     * @return array Les informations du films
     */
    public function selectPokemonById(int $pokeId): array
    {
        $sql = "SELECT * FROM pokemon WHERE id = :id;";
        $params = [
            'id' => $pokeId
        ];

        $query = $this->connection->prepare($sql);
        $query->execute($params);

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result[0] ?? [];
    }




    /**
     * Ajoute un film
     * 
     * @param array $data Les données du film
     * 
     * @return array Les informations du film ajouté avec son id
     */
    public function createPokemon(array $data): array
    {
        $sql = "INSERT INTO pokemon (nom, type, abilite, stats_total)
                VALUES (:nom, :type, :abilite, :stats_total);
        ";
        
        $params = [
            "nom" => $data['nom'] ?? "",
            "type"=> $data['type'] ?? "",
            "abilite"=> $data['abilite'] ?? null,
            "stats_total"=> $data['stats_total'] ?? "",
        ];

        $query = $this->connection->prepare($sql);
        // L'insertion est fait ici
        $query->execute($params);
        // Je récupère le id qui vient d'être créé
        $pokeId = $this->connection->lastInsertId();
        // Je veux retourner à l'usager le film créé avec le nouveau id, je me sers de la fonction que j'ai 
        // déjà pour sélectionner un film par son id. En même temps ça me prouve qu'il est bien créé.
        // C'est pas à toute épreuve comme gestion d'erreur mais pour l'instant on ne s'en occupe pas.
        $result = $this->selectPokemonById($pokeId);

        return $result;
    }



    /**
     * Supprime un film selon son id
     *
     * @param int $movieId Le id du film à supprimer
     *
     * @return bool La suppression à réussi
     */
    public function deletePokemon(int $pokemonId): bool
    {
        $params = ['id' => $pokemonId];
        $sql = "DELETE FROM pokemon WHERE id = :id";

        $query = $this->connection->prepare($sql);
        $result = $query->execute($params);

        /*
        J'ai laissé ce bout de code en commentaire. C'est une façon de récupérer les erreurs sql s'il y en a.
        plus de détail ici : https://www.php.net/manual/fr/pdo.errorinfo.php
        La ligne avec le "logger" sert à écrire dans un fichier de log l'erreur. Si on veut s'en servir il y a une déclaration a
        faire dans le constructeur de la classe. Voir les notes de cours sur les fichiers de logs.
        */
        // $errorInfo = $query->errorInfo();
        // if($errorInfo[0] != 0) {
        //     $this->logger->error($errorInfo[2]);
        // }

        return $result;
    }




    /**
     * Modifie un film
     * 
     * @param int $id Le id du film à modifier
     * @param array $data Les données du film à modifier
     * 
     * @return array Le film modifié
     */
    public function updatePokemon(int $id, array $data): array
    {
        
        $sql = "UPDATE pokemon
                SET nom = :nom, 
                    type = :type, 
                    abilite = :abilite, 
                    stats_total = :stats_total
                WHERE id =:id;";
        
        $params = [
            "id" => $id,
            "nom" => $data['nom'] ?? "",
            "type"=> $data['type'] ?? "",
            "abilite"=> $data['abilite'] ?? null,
            "stats_total"=> $data['stats_total'] ?? "",
        ];
        
        $query = $this->connection->prepare($sql);
        $query->execute($params);

        $result = $this->selectPokemonById($id);

        return $result;
    }
}

