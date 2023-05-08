<?php

namespace App\Domain\Pokemon\Service;

use App\Domain\Pokemon\Repository\PokemonRepository;

/**
 * Service.
 */
final class PokemonCreate
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
     * Ajout d'un film dans la base de données.
     * 
     * @param array $data Les informations à ajouter
     *
     * @return array Le film ajouté
     */
    public function addPokemon(array $data): array
    {

        $pokemons = $this->repository->createPokemon($data);

        return $pokemons ?? [];
    }


}
