<?php

namespace App\Domain\Pokemon\Service;

use App\Domain\Pokemon\Repository\PokemonRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;
use stdClass;

/**
 * Service.
 */
final class PokemonDelete
{
    /**
     * @var PokemonRepository
     */
    private $repository;
    
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(PokemonRepository $repository, LoggerFactory $loggerFactory)
    {
        $this->repository = $repository;
        $this->logger = $loggerFactory
            ->addFileHandler('PokemonLog.log')
            ->createLogger('deleteMovie');
    }

    /**
     * Supprime un film dans la base de données.
     * 
     * @param int $idMovie Le id du film à supprimer
     *
     * @return array Le film supprimé
     */
    public function removePokemon(int $idPokemon): array
    {

        // Je vais chercher les informations du film à supprimer
        // Pour valider qu'il existe bien et aussi pour les retourner à l'usager après la suppression
        $pokemonToDelete = $this->repository->selectPokemonById($idPokemon);
        // Par défaut le code de statut sera 200 - Succès
        $codeStatus = 200;

        // Si le film n'existe pas on change pour le code 404, sinon on supprime le film
        if(empty($pokemonToDelete)) {
            $codeStatus = 404;
        } else {
            if($this->repository->deletePokemon($idPokemon)) {
                $this->logger->info('Le film "' . $pokemonToDelete['nom'] . '" id [' . $idPokemon . '] a été supprimé.');
            };
        }
        
        // Si le film n'existe pas, on retourne un objet vide
        // J'ai créer un tableau avec le film et le code de statut pour pouvoir les retourner tous les deux avec ma fonction
        $resultat = [
            "pokemon" => empty($pokemonToDelete) ? new stdClass : $pokemonToDelete,
            "codeStatus" => $codeStatus
        ];

        return $resultat;
    }


}