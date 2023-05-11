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
     * Modification d'un pokemon dans la base de données.
     * 
     * @param int $id Le id du pokemon à modifier
     * @param array $data Les informations à modifier
     *
     * @return array Le pokemon ajouté
     */
    public function updatePokemon(int $id, array $data): array
    {


        $oldPokemon = $this->repository->selectPokemonById($id);
        $codeStatus = 200;

        if(empty($oldPokemon)) {
           
            $pokemon = $this->repository->createPokemon($data); 
            $codeStatus = 201;   
        } else {
            
            $pokemon = $this->repository->updatePokemon($id, $data);
        }

        $resultat = [
            "pokemon" => $pokemon,
            "codeStatus" => $codeStatus
        ];

        return $resultat;
    }


}