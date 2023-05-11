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
     * Sélectionne la liste de tous les pokemon
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
     * Sélectionne les informations d'un pokemon
     * 
     * @param int $pokeId Le id du pokemon à afficher
     * 
     * @return array Les informations du pokemon
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
     * Ajoute un pokemon
     * 
     * @param array $data Les données du pokemon
     * 
     * @return array Les informations du pokemon ajouté avec son id
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

        $result = $this->selectPokemonById($pokeId);

        return $result;
    }



    /**
     * Supprime un pokemon selon son id
     *
     * @param int $pokemonId Le id du pokemon à supprimer
     *
     * @return bool La suppression à réussi
     */
    public function deletePokemon(int $pokemonId): bool
    {
        $params = ['id' => $pokemonId];
        $sql = "DELETE FROM pokemon WHERE id = :id";

        $query = $this->connection->prepare($sql);
        $result = $query->execute($params);

        return $result;
    }




    /**
     * Modifie un pokeon
     * 
     * @param int $id Le id du pokemon à modifier
     * @param array $data Les données du pokemon à modifier
     * 
     * @return array Le pokemon modifié
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

