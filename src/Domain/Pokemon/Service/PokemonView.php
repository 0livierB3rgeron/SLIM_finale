<?php

namespace App\Domain\Pokemon\Service;

use App\Domain\Pokemon\Repository\PokemonRepository;

/**
 * Service.
 */
final class PokemonView
{
    /**
     * @var PokemonRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param PokemonRepository $repository
     */
    public function __construct(PokemonRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Sélectionne tous les films.
     *
     * @return array La liste des films
     */
    public function viewAllPokemon(): array
    {

        $Pokemons = $this->repository->selectAllPokemon();

        // Tableau qui contient la réponse à retourner à l'usager
        $resultat = [
            "Pokemon" => $Pokemons
        ];

        return $resultat;
    }

    /**
     * Sélectionne un film selon son id.
     *
     * @return array Les informations d'un film
     */
    public function viewPokemonById(int $pokemonId): array
    {

        $pokemon = $this->repository->selectPokemonById($pokemonId);

        return $pokemon;
    }


}
