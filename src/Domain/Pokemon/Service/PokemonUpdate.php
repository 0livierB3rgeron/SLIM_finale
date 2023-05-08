<?php

namespace App\Domain\Pokemon\Service;

use App\Domain\Pokemon\Repository\PokemonRepository;

/**
 * Service.
 */
final class PokemonUpdate
{
    /**
     * @var PokemonRepository
     */
    private $repository;

    public function __construct(PokemonRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Modification d'un film dans la base de données.
     * 
     * @param int $id Le id du film à modifier
     * @param array $data Les informations à modifier
     *
     * @return array Le film ajouté
     */
    public function updatePokemon(int $id, array $data): array
    {

        // L'idée avec la méthode PUT est que si la ressource à modifier n'existe pas, on doit la créer.
        
        // Teste si le film existe dans la base de données
        $oldPokemon = $this->repository->selectPokemonById($id);
        $codeStatus = 200;

        if(empty($oldPokemon)) {
            // Création d'un nouveau film
            $pokemon = $this->repository->createPokemon($data); 
            $codeStatus = 201;   
        } else {
            // Modification du film existant
            $pokemon = $this->repository->updatePokemon($id, $data);
        }

        $resultat = [
            "pokemon" => $pokemon,
            "codeStatus" => $codeStatus
        ];

        return $resultat;
    }


}